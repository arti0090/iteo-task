<?php

namespace App\Serializer;

use App\DTO\Client;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class ClientDTONormalizer implements DenormalizerInterface
{
    public function denormalize(mixed $data, string $type, ?string $format = null, array $context = []): mixed
    {
        $clientDto = new Client($data['name'], $data['balance']);

        if (isset($data['clientId'])) {
            $clientDto->setId($data['clientId']);
        }

        return $clientDto;
    }

    public function supportsDenormalization(mixed $data, string $type, ?string $format = null, array $context = []): bool
    {
        return $type === Client::class;
    }

    public function getSupportedTypes(?string $format): array
    {
        return [Client::class => true];
    }
}