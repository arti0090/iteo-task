<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class OrderWeight extends Constraint
{
    public string $message = "The order total weight must be less than 24 tons";

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}