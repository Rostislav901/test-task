<?php

namespace App\Auth\Domain\Aggregate\Auth\Specification;

use App\Shared\Domain\Specification\EmailSpecificationInterface;

interface AuthEmailSpecificationInterface extends EmailSpecificationInterface
{
    public function emailIsUnique(string $email): void;

    public function satisfy(string $email): void;
}
