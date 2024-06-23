<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification\Exception;

class ParentCanNotBeSelfException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('Parent cannot be self');
    }
}
