<?php

namespace App\ApiClient;

use App\DTO\Order;

interface OrderApiClientInterface
{
    public function postOrder(Order $order): string|int|bool|\ArrayObject|array|null|float;
}