<?php

namespace App\Product\Application\DTO\Product;

class CategoryForProductResponseDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}
