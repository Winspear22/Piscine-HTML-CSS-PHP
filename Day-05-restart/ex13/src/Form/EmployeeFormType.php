<?php

namespace App\Form;

use App\Entity\Employee;
use App\Enum\EmployeeHours;
use App\Enum\EmployeePosition;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Doctrine\ORM\EntityRepository;

class EmployeeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', null, [
                'label' => 'Prénom',
                'required' => true,
            ])
            ->add('lastname', null, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => true,
            ])
            ->add('birthdate', DateType::class, [
                'label' => 'Date de naissance',
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('active', CheckboxType::class, [
                'label' => 'Actif ?',
                'required' => false,
            ])
            ->add('employed_since', DateType::class, [
                'label' => "Embauché depuis",
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('employed_until', DateType::class, [
                'label' => "Embauché jusqu'à",
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('hours', ChoiceType::class, [
                'label' => "Heures de travail",
                'choices' => [
                    '8 heures' => EmployeeHours::Eight,
                    '6 heures' => EmployeeHours::Six,
                    '4 heures' => EmployeeHours::Four,
                ],
                'required' => true,
            ])
            ->add('salary', IntegerType::class, [
                'label' => "Salaire",
                'required' => true,
            ])
            ->add('position', ChoiceType::class, [
                'label' => "Poste",
                'choices' => [
                    'Manager' => EmployeePosition::Manager,
                    'Account manager' => EmployeePosition::AccountManager,
                    'QA manager' => EmployeePosition::QaManager,
                    'Dev manager' => EmployeePosition::DevManager,
                    'CEO' => EmployeePosition::Ceo,
                    'COO' => EmployeePosition::Coo,
                    'Backend dev' => EmployeePosition::BackendDev,
                    'Frontend dev' => EmployeePosition::FrontendDev,
                    'QA tester' => EmployeePosition::QaTester,
                ],
                'required' => true,
            ])
        ;

        // Masquer le champ manager si c'est le premier employé ou si on crée/édite un CEO
        if (!($options['hide_manager'] ?? false)) {
            if (($options['restrict_manager_to_ceo'] ?? false) && isset($options['ceo']) && $options['ceo']) {
                // Seul le CEO peut être choisi comme manager
                $builder->add('manager', EntityType::class, [
                    'class' => Employee::class,
                    'choice_label' => fn($emp) => $emp->getFirstname() . ' ' . $emp->getLastname(),
                    'choices' => [$options['ceo']],
                    'label' => 'Manager (seul le CEO peut être choisi)',
                    'required' => true,
                    'placeholder' => false,
                ]);
            } else {
                $currentEmployee = $options['current_employee'] ?? null;
                $builder->add('manager', EntityType::class, [
                    'class' => Employee::class,
                    'choice_label' => fn($emp) => $emp->getFirstname() . ' ' . $emp->getLastname(),
                    'query_builder' => function (EntityRepository $er) use ($currentEmployee) {
                        $qb = $er->createQueryBuilder('e');
                        if ($currentEmployee) {
                            $qb->where('e != :current')->setParameter('current', $currentEmployee);
                        }
                        return $qb;
                    },
                    'label' => 'Manager',
                    'required' => true,
                    'placeholder' => 'Choisissez un manager',
                ]);
            }
        }
        $builder->add('save', SubmitType::class, [
            'label' => 'Enregistrer',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Employee::class,
            'first_employee' => false,
            'hide_manager' => false,
            'restrict_manager_to_ceo' => false,
            'ceo' => null,
            'current_employee' => null,
        ]);
    }
}
