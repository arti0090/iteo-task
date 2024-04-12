<?php

namespace App\DTO;

class Client
{
    private ?string $id = null;

    private ?string $name = null;

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
