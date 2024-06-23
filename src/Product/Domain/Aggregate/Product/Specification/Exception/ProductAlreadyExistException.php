<?php

namespace App\Product\Domain\Aggregate\Product\Specification\Exception;

class ProductAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('ProductName must bee unique by user');
    }
}
