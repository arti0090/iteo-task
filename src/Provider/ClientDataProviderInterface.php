<?php

namespace App\Provider;

use App\DTO\Client;

interface ClientDataProviderInterface
{
    public function findOneById(string $id): ?Client;
}