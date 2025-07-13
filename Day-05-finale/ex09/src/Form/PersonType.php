<?php

namespace App\Form;

use App\Entity\Person;
use App\Entity\BankAccount;
use App\Enum\MaritalStatus;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username')
            ->add('name')
            ->add('email')
            ->add('enable')
            ->add('birthdate')
            ->add('marital_status', ChoiceType::class, [
            'choices' => [
                'Célibataire' => MaritalStatus::SINGLE,
                'Marié(e)'    => MaritalStatus::MARRIED,
                'Veuf(ve)'    => MaritalStatus::WIDOWER,
            ],
            'choice_label' => fn($choice, $key, $value) => $choice->value,
            'choice_value' => fn(?MaritalStatus $enum) => $enum?->value,
            'placeholder' => 'Sélectionner un statut',
            'required' => false,
        ])
            ->add('bankAccount', EntityType::class, [ // <-- corrige ici
            'class' => BankAccount::class,
            'choice_label' => 'id',
            'required' => false, // ou true selon le cas
            'placeholder' => 'Sélectionner un compte bancaire',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}
