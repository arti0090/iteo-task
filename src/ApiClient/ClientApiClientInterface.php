<?php

namespace App\ApiClient;

use App\DTO\Client;

interface ClientApiClientInterface
{
    public function postClient(Client $client): void;
}