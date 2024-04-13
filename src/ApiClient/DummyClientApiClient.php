<?php

namespace App\ApiClient;

use App\DTO\Client;

class DummyClientApiClient implements ClientApiClientInterface
{
    public function postClient(Client $client): void
    {
        return;
    }
}