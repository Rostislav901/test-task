<?php

namespace App\Auth\Domain\Aggregate\Auth\Specification\Exception;

class AuthEmailAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Email must bee unique');
    }
}
