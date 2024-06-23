<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification;

class RootCategorySpecification
{
    public function __construct(
        private readonly CategoryNameSpecification $categoryNameSpecification,
        private readonly CategoryParentSpecification $categoryParentSpecification)
    {
    }

    public function getCategoryNameSpecification(): CategoryNameSpecification
    {
        return $this->categoryNameSpecification;
    }

    public function getCategoryParentSpecification(): CategoryParentSpecification
    {
        return $this->categoryParentSpecification;
    }
}
