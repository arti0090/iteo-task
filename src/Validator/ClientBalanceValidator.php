<?php

namespace App\Validator;

use App\ApiClient\ClientApiClientInterface;
use App\DTO\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Webmozart\Assert\Assert;

class ClientBalanceValidator extends ConstraintValidator
{
    public function __construct(
        readonly ClientApiClientInterface $clientApiClient
    ) {
    }
    public function validate(mixed $value, Constraint $constraint): void
    {
        /** Client $value */
        Assert::isInstanceOf($value, Order::class);
        Assert::isInstanceOf($constraint, ClientBalance::class);

        $client = $this->clientApiClient->findById($value->getClientId());

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
