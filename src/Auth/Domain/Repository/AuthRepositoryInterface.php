<?php

namespace App\Auth\Domain\Repository;

use App\Auth\Domain\Aggregate\Auth\Entity\Auth;

interface AuthRepositoryInterface
{
    public function existByEmail(string $email): bool;

    public function add(Auth $auth): void;
}
