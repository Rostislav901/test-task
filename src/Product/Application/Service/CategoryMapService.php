<?php

namespace App\Product\Application\Service;

use App\Product\Application\DTO\Category\CategoryItemDTO;
use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Repository\CategoryRepositoryInterface;

class CategoryMapService
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    /**
     * @param CategoryItemDTO[] $categories
     *
     * @return Category[]
     */
    public function mapCategoryInEntity(array $categories): array
    {
        return array_map(fn (CategoryItemDTO $categoryItemDTO) => $this->categoryRepository->findCategoryByName($categoryItemDTO->category),
            $categories);
    }
}
