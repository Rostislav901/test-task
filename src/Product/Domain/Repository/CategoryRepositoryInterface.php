<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    public function add(Category $category): void;

    public function existByName(string $name): bool;

    public function findCategoryByName(string $categoryName): Category;

    /**
     * @return Category[]
     */
    public function getChildCategory(Category $category): array;

    /**
     * @return Category[]
     */
    public function getAllCategories(): array;

    public function findCategoryByIdAndAuthUlid(int $id, string $authUlid): Category;

    public function persist(Category $category): void;

    public function flush(): void;

    public function removeNotFlushed(Category $category): void;
}
