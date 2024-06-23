<?php

namespace App\Product\Application\DTO\Product;

class ProductsResponseDTO
{
    /**
     * @param ProductResponseItemDTO[] $products
     */
    public function __construct(public readonly array $products)
    {
    }
}
