<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification;

use App\Product\Domain\Aggregate\Product\Category\Specification\Exception\CategoryAlreadyExistException;
use App\Product\Domain\Repository\CategoryRepositoryInterface;

class CategoryNameSpecification
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    private function nameIsUnique(string $categoryName): void
    {
        true !== $this->categoryRepository->existByName($categoryName) ?: throw new CategoryAlreadyExistException();
    }

    public function satisfy(string $categoryName): void
    {
        $this->nameIsUnique($categoryName);
    }
}
