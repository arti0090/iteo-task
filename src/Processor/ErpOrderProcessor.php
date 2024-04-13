<?php

namespace App\Processor;

use App\DTO\Order;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ErpOrderProcessor implements OrderProcessorInterface
{
    const ERP_URL = 'URL';

    public function __construct(
        readonly HttpClientInterface $client,
        readonly NormalizerInterface $normalizer
    ) {
    }

    public function postOrder(Order $order): void
    {
        $this->client->request(
            'POST',
            self::ERP_URL . '/order',
            [
                'body' => $this->normalizer->normalize($order)
            ],
        );
    }
}