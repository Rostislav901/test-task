<?php

namespace App\Product\Application\Transformer;

use App\Product\Application\DTO\Category\CategoryResponseItemDTO;
use App\Product\Domain\Aggregate\Product\Category\Entity\Category;

class CategoryTransformer
{
    public function __construct()
    {
    }

    /**
     * @param Category[] $categoriesEntityList
     *
     * @return CategoryResponseItemDTO[]
     */
    public function fromEntityListToResponseListDto(array $categoriesEntityList): array
    {
        $res = [];
        foreach ($categoriesEntityList as $categoryEntity) {
            $res[] = $this->fromEntityToResponseDto($categoryEntity);
        }

        return $res;
    }

    public function fromEntityToResponseDto(Category $category): CategoryResponseItemDTO
    {
        return new CategoryResponseItemDTO(
            id: $category->getId(),
            name: $category->getName(),
            description: $category->getDescription(),
            parent: $category->getParent()?->getName()
        );
    }
}
