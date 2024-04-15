<?php

namespace App\ApiClient;

use App\DTO\Client;

interface ClientApiClientInterface
{
    public function postClient(Client $client): string|int|bool|\ArrayObject|array|null|float;

    public function findById(string $id): ?Client;
}