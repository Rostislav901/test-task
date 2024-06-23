<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification\Exception;

class ChildCanNotBeParentException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Child category cannot be parent.');
    }
}
