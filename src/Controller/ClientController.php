<?php

namespace App\Controller;

use App\ApiClient\ClientApiClientInterface;
use App\DTO\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Provider\ClientDataProviderInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ClientController extends AbstractController
{
    #[Route('/client/{id}/balance', name: 'app_client_show', methods: 'GET')]
    public function show(string $id, ClientDataProviderInterface $clientDataProvider): JsonResponse
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

    #[Route('/client/new', name: 'app_client_new', methods: 'POST')]
    public function new(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        ClientApiClientInterface $clientApiClient
    ): JsonResponse {
        $client = $serializer->deserialize($request->getContent(), Client::class, 'json');

        $errors = $validator->validate($client);

        if (count($errors) > 0) {
            $validationErrors = [];
            foreach ($errors as $error) {
                $validationErrors[] = [
                    'property' => $error->getPropertyPath(),
                    'message' => $error->getMessage(),
                ];
            }

            return new JsonResponse([
                'message' => 'Client validation failed',
                'errors' => $validationErrors,
            ], Response::HTTP_BAD_REQUEST);
        }

        $clientApiClient->postClient($client);


        return $this->json([]);
    }
}
