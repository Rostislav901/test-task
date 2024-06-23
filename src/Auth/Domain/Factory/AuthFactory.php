<?php

namespace App\Auth\Domain\Factory;

use App\Auth\Domain\Aggregate\Auth\Entity\Auth;
use App\Auth\Domain\Aggregate\Auth\Specification\AuthEmailSpecificationInterface;
use App\Auth\Domain\Aggregate\Auth\ValueObject\AuthEmail;
use App\Auth\Domain\Service\AuthPasswordHasherInterface;

class AuthFactory
{
    public function __construct(
        private readonly AuthPasswordHasherInterface $passwordHasher,
        private readonly AuthEmailSpecificationInterface $emailSpecification)
    {
    }

    public function create(
        string $email,
        string $password
    ): Auth {
        $auth = new Auth(
            email: new AuthEmail($email, $this->emailSpecification),
            password: $password
        );

        $auth->setPassword($this->passwordHasher->hash($auth, $password));

        return $auth;
    }
}
