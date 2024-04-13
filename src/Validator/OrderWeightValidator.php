<?php

namespace App\Validator;

use App\DTO\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

class OrderWeightValidator extends ConstraintValidator
{
    // 24000 kg = 24 t
    const MAX_WEIGHT = 24000.0;
    public function validate(mixed $value, Constraint $constraint): void
    {
        Assert::isInstanceOf($value, Order::class);
        Assert::isInstanceOf($constraint, OrderWeight::class);

        $totalWeight = 0;
        foreach ($value->getProducts() as $product) {
            $totalWeight =+ $product->getWeight();
        }

        if ($totalWeight > self::MAX_WEIGHT) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('order.products')
                ->addViolation();
        }

    }
}