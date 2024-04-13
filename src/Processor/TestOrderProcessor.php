<?php

namespace App\Processor;

use App\DTO\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

readonly class TestOrderProcessor implements OrderProcessorInterface
{
    public function __construct(
        private NormalizerInterface $normalizer
    ) {
    }
    public function postOrder(Order $order): void
    {
        $normalizedOrder = $this->normalizer->normalize($order);

        return;
    }
}