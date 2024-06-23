<?php

namespace App\Product\Domain\Aggregate\Product\Specification;

class RootProductSpecification
{
    public function __construct(private readonly ProductNameSpecification $productNameSpecification)
    {
    }

    public function getProductNameSpecification(): ProductNameSpecification
    {
        return $this->productNameSpecification;
    }
}
