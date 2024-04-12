<?php

namespace App\Provider;

use App\DTO\Client;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ClientCRMDataProvider implements ClientDataProviderInterface
{
    const URL = 'PUT URL HERE'; 

    public function __construct(
        private HttpClientInterface $client,
        private SerializerInterface $serializer
    ) {
    }

    public function findOneById(string $id): ?Client
    {
        $response = $this->client->request(
            'GET',
            self::URL . $id
        );

        $client = $this->serializer->deserialize($response->getContent(), Client::class, 'json');

        return $client;
    }
}