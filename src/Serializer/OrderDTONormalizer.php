<?php

namespace App\Serializer;

use App\DTO\Order;
use App\DTO\Product;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

readonly class OrderDTONormalizer implements DenormalizerInterface
{
    public function __construct(
        #[Autowire(service: 'serializer.normalizer.object')]
        private NormalizerInterface $normalizer,
    ) {
    }

    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $orderDto = new Order();
        $orderDto->setId($data['orderId']);
        $orderDto->setClientId($data['clientId']);

        foreach ($data['products'] as $productData) {
            $productDto = new Product();
            $productDto->setId($productData['productId']);
            $productDto->setQuantity($productData['quantity']);
            $productDto->setPrice($productData['price']);
            $productDto->setWeight($productData['weight']);

            $orderDto->products[] = $productDto;
        }

        return $orderDto;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Order::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Order::class => true];
    }
}