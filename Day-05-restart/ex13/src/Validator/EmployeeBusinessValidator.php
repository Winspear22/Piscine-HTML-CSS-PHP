<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\Entity\Employee;
use App\Enum\EmployeePosition;
use Doctrine\ORM\EntityManagerInterface;

class EmployeeBusinessValidator extends ConstraintValidator
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Employee $employee
     * @param EmployeeBusiness $constraint
     */
	public function validate($employee, Constraint $constraint)
	{
		if (!$employee instanceof Employee) return;

		$repo = $this->em->getRepository(Employee::class);

		// --- 1. Un seul CEO/COO ---
		if ($employee->getPosition() === EmployeePosition::Ceo) {
			$existing = $repo->findOneBy(['position' => EmployeePosition::Ceo]);
			if ($existing && ($employee->getId() === null || $employee->getId() !== $existing->getId())) {
				$this->context->buildViolation('Il existe déjà un CEO.')
					->atPath('position')
					->addViolation();
			}
			// CEO ne doit pas avoir de manager
			if ($employee->getManager() !== null) {
				$this->context->buildViolation('Le CEO ne peut pas avoir de manager.')
					->atPath('manager')
					->addViolation();
			}
		}

		if ($employee->getPosition() === EmployeePosition::Coo) {
			$existing = $repo->findOneBy(['position' => EmployeePosition::Coo]);
			if ($existing && ($employee->getId() === null || $employee->getId() !== $existing->getId())) {
				$this->context->buildViolation('Il existe déjà un COO.')
					->atPath('position')
					->addViolation();
			}
			// COO doit avoir le CEO comme manager
			if (!$employee->getManager() || $employee->getManager()->getPosition() !== EmployeePosition::Ceo) {
				$this->context->buildViolation('Le COO doit avoir le CEO comme manager.')
					->atPath('manager')
					->addViolation();
			}
		}

		// --- 2. Manager obligatoire sauf pour CEO ---
		if ($employee->getPosition() && $employee->getPosition() !== EmployeePosition::Ceo && !$employee->getManager()) {
			$this->context->buildViolation('Le manager est obligatoire, sauf pour le CEO.')
				->atPath('manager')
				->addViolation();
		}

		// --- 3. Date d'embauche cohérente (>= naissance et >= 18 ans) ---
		if ($employee->getBirthdate() && $employee->getEmployedSince()) {
			$legal18 = (clone $employee->getBirthdate())->modify('+18 years');
			if ($employee->getEmployedSince() < $employee->getBirthdate() || $employee->getEmployedSince() < $legal18) {
				$this->context->buildViolation("La date d'embauche ne peut pas être avant la date de naissance, ni avant ses 18 ans.")
					->atPath('employed_since')
					->addViolation();
			}
		}

		// --- 4. employed_until >= birthdate + 18 ans ET >= birthdate ---
		if ($employee->getBirthdate() && $employee->getEmployedUntil()) {
			$legal18 = (clone $employee->getBirthdate())->modify('+18 years');
			if ($employee->getEmployedUntil() < $employee->getBirthdate() || $employee->getEmployedUntil() < $legal18) {
				$this->context->buildViolation("La date de fin de contrat ne peut pas être avant la date de naissance, ni avant ses 18 ans.")
					->atPath('employed_until')
					->addViolation();
			}
		}

		// --- 5. employed_until >= employed_since ---
		if ($employee->getEmployedSince() && $employee->getEmployedUntil()) {
			if ($employee->getEmployedUntil() < $employee->getEmployedSince()) {
				$this->context->buildViolation("La date de fin doit être après la date d'embauche.")
					->atPath('employed_until')
					->addViolation();
			}
		}

		// --- 6. Boucle hiérarchique (détection d'une boucle simple, inclut “un employé ne peut pas être son propre manager”) ---
		$current = $employee->getManager();
		$seen = [];
		while ($current) {
			if ($current->getId() === $employee->getId()) {
				$this->context->buildViolation("Boucle hiérarchique détectée : un employé ne peut pas être dans sa propre chaîne de managers.")
					->atPath('manager')
					->addViolation();
				break;
			}
			if (in_array($current->getId(), $seen)) break;
			$seen[] = $current->getId();
			$current = $current->getManager();
		}

		// --- 7. Le manager doit exister dans la base (vérification doctrine) ---
		if ($employee->getManager() && !$this->em->getRepository(Employee::class)->find($employee->getManager()->getId())) {
			$this->context->buildViolation("Le manager sélectionné n'existe pas/plus.")
				->atPath('manager')
				->addViolation();
		}

		// --- 8. Le salaire doit être réaliste ---
		if ($employee->getSalary() !== null) {
			if ($employee->getSalary() < 1000 || $employee->getSalary() > 1000000) {
				$this->context->buildViolation("Le salaire doit être compris entre 1 000 et 1 000 000 €.")
					->atPath('salary')
					->addViolation();
			}
		}

		// --- 9. Les prénoms et noms doivent être alpha (pas de chiffre ni symboles) ---
		if ($employee->getFirstname() && !preg_match('/^[\p{L} \'-]+$/u', $employee->getFirstname())) {
			$this->context->buildViolation("Le prénom ne doit contenir que des lettres, espaces, apostrophes ou tirets.")
				->atPath('firstname')
				->addViolation();
		}
		if ($employee->getLastname() && !preg_match('/^[\p{L} \'-]+$/u', $employee->getLastname())) {
			$this->context->buildViolation("Le nom ne doit contenir que des lettres, espaces, apostrophes ou tirets.")
				->atPath('lastname')
				->addViolation();
		}

		// --- 10. Date de naissance ne peut pas être dans le futur ---
		if ($employee->getBirthdate() && $employee->getBirthdate() > new \DateTime()) {
			$this->context->buildViolation("La date de naissance ne peut pas être dans le futur.")
				->atPath('birthdate')
				->addViolation();
		}

		// --- 11. Date d’embauche ne peut pas être dans le futur ---
		if ($employee->getEmployedSince() && $employee->getEmployedSince() > new \DateTime()) {
			$this->context->buildViolation("La date d'embauche ne peut pas être dans le futur.")
				->atPath('employed_since')
				->addViolation();
		}

		// --- 12. Date de naissance pas trop ancienne ---
		if ($employee->getBirthdate() && $employee->getBirthdate() < (new \DateTime())->modify('-100 years')) {
			$this->context->buildViolation("La date de naissance n'est pas réaliste (plus de 100 ans).")
				->atPath('birthdate')
				->addViolation();
		}

		// --- 13. Heures travaillées cohérentes selon le poste ---
		if ($employee->getPosition() === EmployeePosition::Ceo && $employee->getHours() && $employee->getHours()->value !== '8') {
			$this->context->buildViolation("Un CEO doit avoir un temps plein (8h).")
				->atPath('hours')
				->addViolation();
		}

		// --- 14. Logique hiérarchique custom selon le poste du manager ---
		if ($employee->getManager() && $employee->getPosition()) {
			$managerPos = $employee->getManager()->getPosition();
			$employeePos = $employee->getPosition();

			// COO ne peut pas manager le CEO ni lui-même
			if ($managerPos === EmployeePosition::Coo) {
				if ($employeePos === EmployeePosition::Ceo || $employee->getManager()->getId() === $employee->getId()) {
					$this->context->buildViolation("Le COO ne peut pas manager le CEO ni lui-même.")
						->atPath('manager')
						->addViolation();
				}
			}

			// QA manager et Account manager ne peuvent manager que des QA
			if (
				$managerPos === EmployeePosition::QaManager ||
				$managerPos === EmployeePosition::AccountManager
			) {
				if (
					$employeePos !== EmployeePosition::QaManager &&
					$employeePos !== EmployeePosition::QaTester
				) {
					$this->context->buildViolation("Seuls les QA peuvent être sous un QA manager ou un account manager.")
						->atPath('manager')
						->addViolation();
				}
			}

			// Dev manager ne peut manager que des devs frontend ou backend
			if ($managerPos === EmployeePosition::DevManager) {
				if (
					$employeePos !== EmployeePosition::BackendDev &&
					$employeePos !== EmployeePosition::FrontendDev
				) {
					$this->context->buildViolation("Seuls les développeurs frontend ou backend peuvent être sous un dev manager.")
						->atPath('manager')
						->addViolation();
				}
			}
		}
	}
}
