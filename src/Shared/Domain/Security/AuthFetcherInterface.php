<?php

namespace App\Shared\Domain\Security;

interface AuthFetcherInterface
{
    public function getAuth(): AuthInterface;
}
