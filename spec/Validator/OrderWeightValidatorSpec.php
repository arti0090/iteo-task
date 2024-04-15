<?php

namespace spec\App\Validator;

use App\DTO\Order;
use App\DTO\Product;
use App\Validator\OrderWeight;
use App\Validator\OrderWeightValidator;
use PhpSpec\ObjectBehavior;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

class OrderWeightValidatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(OrderWeightValidator::class);
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
            ->during('validate', ['string', new OrderWeight()])
        ;
    }

    function it_adds_violation_when_weight_is_higher_than_24_tons(
        ExecutionContextInterface $executionContext,
        Order $order,
        Product $product,
        ConstraintViolationBuilderInterface $constraintViolationBuilder,
        OrderWeight $constraint
    ): void {
        $this->initialize($executionContext);

        $product->getWeight()->willReturn(241000);
        $order->getProducts()->willReturn([$product]);

        $executionContext->buildViolation($constraint->message)->willReturn($constraintViolationBuilder);
        $constraintViolationBuilder->atPath('products')->willReturn($constraintViolationBuilder);
        $constraintViolationBuilder->addViolation()->shouldBeCalled();

        $this->validate($order, $constraint);
    }

    function it_does_nothing_when_weight_does_not_exceed_24_tons(
        ExecutionContextInterface $executionContext,
        Order $order,
        Product $product,
        OrderWeight $constraint
    ): void {
        $this->initialize($executionContext);

        $product->getWeight()->willReturn(2400);
        $order->getProducts()->willReturn([$product]);

        $executionContext->buildViolation($constraint->message)->shouldNotBeCalled();

        $this->validate($order, $constraint);

    }
}
