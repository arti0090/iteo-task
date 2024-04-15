<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;
use App\Validator as AssertValidator;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[AssertValidator\ClientBalance]
#[AssertValidator\OrderWeight]
class Order
{
    #[SerializedName('orderId')]
    private ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $clientId = null;

    #[Assert\Count(
        min: 5,
        minMessage: 'Order needs at least 5 products',
    )]
    public array $products = [];

    public function __construct()
    {
        $this->products = [];
    }
    
    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getClientId(): ?string
    {
        return $this->clientId;
    }

    public function setClientId(string $clientId): static
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getProducts(): array
    {
        return $this->products;
    }

    public function setProducts(array $products): static
    {
        $this->products = $products;

        return $this;
    }
}
