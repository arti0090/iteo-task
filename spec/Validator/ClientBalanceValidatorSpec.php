<?php

namespace spec\App\Validator;

use App\DTO\Client;
use App\DTO\Order;
use App\DTO\Product;
use App\Provider\ClientDataProviderInterface;
use App\Validator\ClientBalanceValidator;
use App\Validator\OrderWeightValidator;
use PhpSpec\ObjectBehavior;
use App\Validator\ClientBalance;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

final class ClientBalanceValidatorSpec extends ObjectBehavior
{
    function let(ClientDataProviderInterface $clientDataProvider): void
    {
        $this->beConstructedWith($clientDataProvider);
    }

    function it_is_initializable(): void
    {
        $this->shouldHaveType(ClientBalanceValidator::class);
    }

    function it_throws_an_exception_if_constraint_is_not_an_instance_of_client_balance(
        Constraint $constraint
    ): void {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('validate', ['', $constraint])
        ;
    }

    function it_throws_an_exception_if_value_is_not_an_instance_of_order(): void
    {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('validate', ['string', new ClientBalance()])
        ;
    }

    function it_adds_violation_if_customer_has_not_enough_balance(
        ClientDataProviderInterface $clientDataProvider,
        Order $order,
        Client $client,
        Product $product,
        ExecutionContextInterface $executionContext,
        ConstraintViolationBuilderInterface $constraintViolationBuilder
    ): void {
        $constraint = new ClientBalance();
        $this->initialize($executionContext);
        $order->getClientId()->willReturn("any");

        $clientDataProvider->findOneById("any")->willReturn($client);
        $client->getBalance()->willReturn(10);

        $product->getPrice()->willReturn(15);
        $order->getProducts()->willReturn([$product]);

        $executionContext->buildViolation($constraint->message)->willReturn($constraintViolationBuilder);
        $constraintViolationBuilder->atPath('products')->willReturn($constraintViolationBuilder);
        $constraintViolationBuilder->addViolation()->shouldBeCalled();

        $this->validate($order, $constraint);
    }

    function it_does_nothing_when_balance_is_correct(
        ClientDataProviderInterface $clientDataProvider,
        Order $order,
        Client $client,
        Product $product,
        ExecutionContextInterface $executionContext,
        ClientBalance $constraint
    ): void {
        $order->getClientId()->willReturn("any");

        $clientDataProvider->findOneById("any")->willReturn($client);
        $client->getBalance()->willReturn(10);

        $product->getPrice()->willReturn(5);
        $order->getProducts()->willReturn([$product]);

        $executionContext->buildViolation($constraint->message)->shouldNotBeCalled();

        $this->validate($order, $constraint);
    }
}