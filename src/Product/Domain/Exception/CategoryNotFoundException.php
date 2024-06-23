<?php

namespace App\Product\Domain\Exception;

class CategoryNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Category not found');
    }
}
