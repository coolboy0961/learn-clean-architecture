<?php

namespace App\Domain\Entities;

class User
{
    private string $name;
    private string $email;
    public ?string $phoneNumber;

    public function __construct(string $name, string $email, ?string $phoneNumber = null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }
}
