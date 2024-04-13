<?php

namespace App\Controller;

use App\ApiClient\OrderApiClientInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\DTO\Order;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class OrderController extends AbstractController
{
    #[Route('/order', name: 'app_order', methods: 'POST')]
    public function new(
        Request $request,
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        OrderApiClientInterface $orderProcessor,
        ): JsonResponse {
        /** @var Order $order */
        $order = $serializer->deserialize($request->getContent(), Order::class, 'json');

        if (!$order) {
            return (new JsonResponse())->setStatusCode(
                Response::HTTP_BAD_REQUEST,
                'Invalid order request'
            );
        }

        $errors = $validator->validate($order);

        if (count($errors) > 0) {
            $validationErrors = [];
            foreach ($errors as $error) {
                $validationErrors[] = [
                    'property' => $error->getPropertyPath(),
                    'message' => $error->getMessage(),
                ];
            }

            return new JsonResponse([
                'message' => 'Order validation failed',
                'errors' => $validationErrors,
            ], Response::HTTP_BAD_REQUEST);
        }

        $orderProcessor->postOrder($order);

        return $this->json(
            $order,
            Response::HTTP_CREATED,
        );
    }
}