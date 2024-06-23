<?php

namespace App\Product\Application\DTO\Category;

class CategoriesResponseDTO
{
    /**
     * @param CategoryResponseItemDTO[] $categories
     */
    public function __construct(public array $categories)
    {
    }
}
