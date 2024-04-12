<?php

namespace App\Provider;

use App\DTO\Client;

class ClientDummyDataProvider implements ClientDataProviderInterface
{
    public function findOneById(string $id): ?Client
    {
        $data = [
            new Client('1', 'Adam', 123),
            new Client('2', 'Bart', 222),
        ];

        $result = null;
        /** Client $client */
        foreach ($data as $client) {
            if ($client->getId() === $id) {
                $result = $client;
                break;
            }
        }

        return $result;
    }
}