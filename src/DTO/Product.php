<?php

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

class Product
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    #[SerializedName('productId')]
    private ?string $id;

    #[Assert\NotBlank]
    #[Assert\Positive]
    private int $quantity = 0;

    #[Assert\NotBlank]
    #[Assert\Positive]
    private float $price = 0.0;

    #[Assert\NotBlank]
    #[Assert\Positive]
    private float $weight = 0.0;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function setWeight(float $weight): static
    {
        $this->weight = $weight;

        return $this;
    }
}