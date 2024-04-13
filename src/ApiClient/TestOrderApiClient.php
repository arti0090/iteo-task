<?php

namespace App\ApiClient;

use App\DTO\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

readonly class TestOrderApiClient implements OrderApiClientInterface
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