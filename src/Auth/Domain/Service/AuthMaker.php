<?php

namespace App\Auth\Domain\Service;

use App\Auth\Domain\Factory\AuthFactory;
use App\Auth\Domain\Repository\AuthRepositoryInterface;
use App\Shared\Domain\Security\AuthInterface;

class AuthMaker
{
    public function __construct(
        private readonly AuthFactory $authFactory,
        private readonly AuthRepositoryInterface $authRepository)
    {
    }

    public function make(
        string $email, string $password
    ): AuthInterface {
        $auth = $this->authFactory->create($email, $password);

        $this->authRepository->add($auth);

        return $auth;
    }
}
