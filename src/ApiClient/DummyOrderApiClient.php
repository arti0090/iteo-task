<?php

namespace App\ApiClient;

use App\DTO\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Uuid;

class DummyOrderApiClient implements OrderApiClientInterface
{
    private array $orders = [];
    public function __construct(
        private readonly NormalizerInterface $normalizer
    ) {
    }
    public function postOrder(Order $order): string|int|bool|\ArrayObject|array|null|float
    {
        $uuid = Uuid::v1();
        $order->setId($uuid->getNode());

        $this->orders[] = $order;

        return $this->normalizer->normalize($order);
    }
}