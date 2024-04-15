<?php

namespace App\ApiClient;

use App\DTO\Client;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Uid\Uuid;

class DummyClientApiClient implements ClientApiClientInterface
{
    private array $data;

    public function __construct(
        private readonly NormalizerInterface $normalizer
    ) {
        $this->data = [
            new Client('Adam', 123, '1'),
            new Client('Bart', 222, '2'),
        ];
    }

    public function postClient(Client $client): string|int|bool|\ArrayObject|array|null|float
    {
        $uuid = Uuid::v1();
        $client->setId($uuid->getNode());

        $this->data[] = $client;

        return $this->normalizer->normalize($client);
    }

    public function findById(string $id): ?Client
    {
        $result = null;

        /** Client $client */
        foreach ($this->data as $client) {
            if ($client->getId() === $id) {
                $result = $client;
                break;
            }
        }

        return $result;
    }
}