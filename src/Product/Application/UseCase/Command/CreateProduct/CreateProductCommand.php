<?php

namespace App\Product\Application\UseCase\Command\CreateProduct;

use App\Product\Application\DTO\Attribute\AttributesDTO;
use App\Product\Application\DTO\Category\CategoriesDTO;
use App\Product\Application\DTO\Product\ImagesDTO;
use App\Product\Application\DTO\Product\ProductInsertDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateProductCommand implements CommandInterface
{
    public function __construct(
        public readonly ProductInsertDTO $productRequestDTO,
        public readonly CategoriesDTO $categoriesDTO,
        public readonly ImagesDTO $imagesDTO,
        public readonly AttributesDTO $attributesDTO)
    {
    }
}
