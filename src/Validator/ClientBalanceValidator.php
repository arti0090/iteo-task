<?php

namespace App\Validator;

use App\DTO\Order;
use App\Provider\ClientDataProviderInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

class ClientBalanceValidator extends ConstraintValidator
{
    public function __construct(
        readonly ClientDataProviderInterface $clientDataProvider
    ) {
    }
    public function validate(mixed $value, Constraint $constraint): void
    {
        /** Client $value */
        Assert::isInstanceOf($value, Order::class);
        Assert::isInstanceOf($constraint, ClientBalance::class);

        $client = $this->clientDataProvider->findOneById($value->getClientId());

        $orderTotal = 0;
        foreach ($value->getProducts() as $product) {
            $orderTotal += $product->getPrice();
        }

        if ($client->getBalance() < $orderTotal) {
            $this->context
                ->buildViolation($constraint->message)
                ->atPath('products')
                ->addViolation();
        }
    }
}
