<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Provider\ClientDataProviderInterface;

class ClientController extends AbstractController
{
    #[Route('/client/{id}/balance', name: 'app_client', methods: 'GET')]
    public function index(string $id, ClientDataProviderInterface $clientDataProvider): JsonResponse
    {

        $client = $clientDataProvider->findOneById($id);

        if (!$client) {
            $response = new JsonResponse();
            $response->setStatusCode(JsonResponse::HTTP_NOT_FOUND);

            return $response;
        }

        return $this->json([
            'clientId' => $client->getId(),
            'balance' => $client->getBalance(),
        ]);
    }
}
