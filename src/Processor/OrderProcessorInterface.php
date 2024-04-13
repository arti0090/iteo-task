<?php

namespace App\Processor;

use App\DTO\Order;

interface OrderProcessorInterface
{
    public function postOrder(Order $order): void;
}