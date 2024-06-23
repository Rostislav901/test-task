<?php

namespace App\Product\Domain\Exception;

class ProductNotFoundException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Product not found');
    }
}
