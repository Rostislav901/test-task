<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification\Exception;

class CategoryAlreadyExistException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Category must bee unique');
    }
}
