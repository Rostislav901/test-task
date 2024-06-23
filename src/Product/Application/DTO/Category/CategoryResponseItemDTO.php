<?php

namespace App\Product\Application\DTO\Category;

class CategoryResponseItemDTO
{
    public function __construct(
        public int $id,
        public string $name,
        public string $description,
        public ?string $parent = null)
    {
    }
}
