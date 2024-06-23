<?php

namespace App\Auth\Domain\Aggregate\Auth\Specification;

use App\Auth\Domain\Aggregate\Auth\Specification\Exception\AuthEmailAlreadyExistException;
use App\Auth\Domain\Repository\AuthRepositoryInterface;
use App\Shared\Domain\Specification\EmailSpecification;

class AuthEmailSpecification extends EmailSpecification implements AuthEmailSpecificationInterface
{
    public function __construct(private readonly AuthRepositoryInterface $authRepository)
    {
    }

    public function emailIsUnique(string $email): void
    {
        true !== $this->authRepository->existByEmail($email) ?: throw new AuthEmailAlreadyExistException();
    }

    public function satisfy(string $email): void
    {
        parent::satisfy($email);
        $this->emailIsUnique($email);
    }
}
