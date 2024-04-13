<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

class Client
{
    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $id = null;

    #[Assert\NotBlank]
    #[Assert\Type('string')]
    private ?string $name = null;

    #[Assert\NotBlank]
    #[Assert\Type('int')]
    private ?int $balance = null;

    public function __construct(
        string $id,
        string $name,
        int $balance
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
