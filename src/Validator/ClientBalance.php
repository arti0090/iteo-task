<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class ClientBalance extends Constraint
{
    public $message = 'The amount of order is more than clients balance.';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}