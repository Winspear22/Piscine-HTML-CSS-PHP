<?php

namespace App\Ex13Bundle\Controller;

use App\Entity\Employee;
use App\Enum\EmployeePosition;
use App\Form\EmployeeFormType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Ex13Controller extends AbstractController
{
    /**
     * @Route("/ex13", name="ex13_index", methods={"GET"})
     */
    public function index(EmployeeRepository $employeeRepository): Response
    {
        $employees = $employeeRepository->findAll();
        return $this->render('index.html.twig', [
            'employees' => $employees,
        ]);
    }

	/**
	 * @Route("/ex13/create", name="ex13_create", methods={"GET", "POST"})
	 */
	public function create(Request $request, EmployeeRepository $repo, EntityManagerInterface $em): Response
	{
		$employee = new Employee();
		$employeeCount = $repo->count([]);
		$ceo = $repo->findOneBy(['position' => EmployeePosition::Ceo]);
		$coo = $repo->findOneBy(['position' => EmployeePosition::Coo]);
		if ($employeeCount === 0)
    		$employee->setPosition(EmployeePosition::Ceo); // force la valeur à CEO


		// Pré-remplissage de la position si elle a été postée
		$postedData = $request->request->all()['employee'] ?? [];
		$futurePosition = $postedData['position'] ?? null;
		$isCeo = $futurePosition === EmployeePosition::Ceo->value;
		$isCoo = $futurePosition === EmployeePosition::Coo->value;

		// Préparation des options à passer au FormType
		$formOptions = [
			'first_employee' => ($employeeCount === 0),
			'ceo' => $ceo,
		];
		// Si on crée un COO, on restreint le manager au CEO uniquement
		if ($isCoo) {
			$formOptions['restrict_manager_to_ceo'] = true;
		}
		// Si on crée un CEO, on masque le champ manager
		if ($isCeo || $employeeCount === 0) {
			$formOptions['hide_manager'] = true;
		}

		$form = $this->createForm(EmployeeFormType::class, $employee, $formOptions);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// Un seul CEO/COO
			if ($employee->getPosition() === EmployeePosition::Ceo && $ceo) {
				$this->addFlash('error', 'Il existe déjà un CEO !');
				return $this->redirectToRoute('ex13_create');
			}
			if ($employee->getPosition() === EmployeePosition::Coo && $coo) {
				$this->addFlash('error', 'Il existe déjà un COO !');
				return $this->redirectToRoute('ex13_create');
			}
			// CEO n'a pas de manager
			if ($employee->getPosition() === EmployeePosition::Ceo && $employee->getManager() !== null) {
				$this->addFlash('error', 'Le CEO ne peut pas avoir de manager.');
				return $this->redirectToRoute('ex13_create');
			}
			// COO doit avoir CEO comme manager
			if ($employee->getPosition() === EmployeePosition::Coo) {
				if (!$employee->getManager() || $employee->getManager()->getPosition() !== EmployeePosition::Ceo) {
					$this->addFlash('error', 'Le COO doit avoir le CEO comme manager.');
					return $this->redirectToRoute('ex13_create');
				}
			}
			$em->persist($employee);
			$em->flush();
			$this->addFlash('success', 'Employé créé avec succès !');
			return $this->redirectToRoute('ex13_index');
		}

		return $this->render('create.html.twig', [
			'form' => $form->createView(),
		]);
	}




    /**
     * @Route("/ex13/{id}", name="ex13_show", methods={"GET"})
     */
    public function show(Employee $employee): Response
    {
        return $this->render('show.html.twig', [
            'employee' => $employee,
        ]);
    }
	
	/**
	 * @Route("/ex13/update/{id}", name="ex13_update", methods={"GET", "POST"})
	 */
	public function update(Request $request, Employee $employee, EmployeeRepository $repo, EntityManagerInterface $em): Response
	{
		$ceo = $repo->findOneBy(['position' => EmployeePosition::Ceo]);
		$formOptions = [
			'ceo' => $ceo,
			'current_employee' => $employee,
		];
		if ($employee->getPosition() === EmployeePosition::Coo) {
			$formOptions['restrict_manager_to_ceo'] = true;
		}
		if ($employee->getPosition() === EmployeePosition::Ceo) {
			$formOptions['hide_manager'] = true;
		}

		$form = $this->createForm(EmployeeFormType::class, $employee, $formOptions);
		$form->handleRequest($request);

		if ($form->isSubmitted() && $form->isValid()) {
			// CEO n'a pas de manager
			if ($employee->getPosition() === EmployeePosition::Ceo && $employee->getManager() !== null) {
				$this->addFlash('error', 'Le CEO ne peut pas avoir de manager.');
				return $this->redirectToRoute('ex13_update', ['id' => $employee->getId()]);
			}
			// COO doit avoir CEO comme manager
			if ($employee->getPosition() === EmployeePosition::Coo) {
				if (!$employee->getManager() || $employee->getManager()->getPosition() !== EmployeePosition::Ceo) {
					$this->addFlash('error', 'Le COO doit avoir le CEO comme manager.');
					return $this->redirectToRoute('ex13_update', ['id' => $employee->getId()]);
				}
			}
			$em->flush();
			$this->addFlash('success', 'Employé modifié avec succès !');
			return $this->redirectToRoute('ex13_index');
		}

		return $this->render('update.html.twig', [
			'form' => $form->createView(),
			'employee' => $employee,
		]);
	}


    /**
     * @Route("/ex13/delete/{id}", name="ex13_delete", methods={"POST"})
     */
    public function delete(Request $request, Employee $employee, EntityManagerInterface $em): Response
    {
        if (count($employee->getEmployees()) > 0) {
            $this->addFlash('error', "Impossible de supprimer ce manager tant qu'il a des employés.");
            return $this->redirectToRoute('ex13_index');
        }

        if ($this->isCsrfTokenValid('delete'.$employee->getId(), $request->request->get('_token'))) {
            $em->remove($employee);
            $em->flush();
            $this->addFlash('success', 'Employé supprimé avec succès.');
        }
        return $this->redirectToRoute('ex13_index');
    }
}
