<?php

namespace App\Auth\Infrastructure\Service;

use App\Auth\Domain\Aggregate\Auth\Entity\Auth;
use App\Auth\Domain\Service\AuthPasswordHasherInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class PasswordHasher implements AuthPasswordHasherInterface
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function hash(Auth $auth, string $password): string
    {
        return $this->hasher->hashPassword($auth, $password);
    }
}
