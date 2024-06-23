<?php

namespace App\Auth\Domain\Aggregate\Auth\Entity;

use App\Auth\Domain\Aggregate\Auth\ValueObject\AuthEmail;
use App\Shared\Domain\Security\AuthInterface;
use App\Shared\Domain\Service\UlidGenerator;

class Auth implements AuthInterface
{
    private string $ulid;
    private AuthEmail $email;

    private string $password;
    private array $roles = ['ROLE_USER'];
    private \DateTimeImmutable $createdAt;

    public function __construct(AuthEmail $email, string $password)
    {
        $this->ulid = UlidGenerator::generate();
        $this->email = $email;
        $this->password = $password;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function getEmail(): string
    {
        return $this->email->getEmail();
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getEmailVO(): AuthEmail
    {
        return $this->email;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function eraseCredentials()
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->email->getEmail();
    }

    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }

    public function setAuthEmail(AuthEmail $email): void
    {
        $this->email = $email;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function setCreatedAtValue(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
