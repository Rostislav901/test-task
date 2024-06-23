<?php

namespace App\Auth\Domain\Service;

use App\Auth\Domain\Aggregate\Auth\Entity\Auth;

interface AuthPasswordHasherInterface
{
    public function hash(Auth $auth, string $password): string;
}
