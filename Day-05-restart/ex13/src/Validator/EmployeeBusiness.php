<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class EmployeeBusiness extends Constraint
{
    public string $message = 'Erreur métier sur l\'employé.';
}
