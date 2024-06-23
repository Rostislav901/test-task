<?php

namespace App\Auth\Domain\Aggregate\Auth\ValueObject;

use App\Auth\Domain\Aggregate\Auth\Specification\AuthEmailSpecificationInterface;
use App\Shared\Domain\ValueObject\Email;
use JetBrains\PhpStorm\Immutable;

#[Immutable]
final class AuthEmail extends Email
{
    public function __construct(string $email, AuthEmailSpecificationInterface $emailSpecification)
    {
        parent::__construct($email, $emailSpecification);
        $this->emailSpecification = $emailSpecification;
    }
}
