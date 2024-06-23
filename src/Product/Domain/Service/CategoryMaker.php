<?php

namespace App\Product\Domain\Service;

use App\Product\Domain\Factory\CategoryFactory;
use App\Product\Domain\Repository\CategoryRepositoryInterface;

class CategoryMaker
{
    public function __construct(
        private readonly CategoryFactory $categoryFactory,
        private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function make(string $name, string $description, ?string $parent = null): void
    {
        $parent = null !== $parent ? $this->categoryRepository->findCategoryByName($parent) : $parent;

        $category = $this->categoryFactory->create(
            name: $name,
            description: $description,
            parent: $parent
        );

        $this->categoryRepository->add($category);
    }
}
