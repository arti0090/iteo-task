<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class Client
{
    private ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $name = null;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    #[Assert\Positive]
    private ?int $balance = null;

    public function __construct(
        string $name,
        int $balance,
        string $id = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getBalance(): ?int
    {
        return $this->balance;
    }

    public function setBalance(int $balance): static
    {
        $this->balance = $balance;

        return $this;
    }
}
