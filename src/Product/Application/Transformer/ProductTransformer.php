<?php

namespace App\Product\Application\Transformer;

use App\Product\Application\DTO\Attribute\AttributeResponseDTO;
use App\Product\Application\DTO\Product\CategoryForProductResponseDTO;
use App\Product\Application\DTO\Product\ProductResponseItemDTO;
use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Aggregate\Product\Entity\Attribute;
use App\Product\Domain\Aggregate\Product\Entity\Product;

class ProductTransformer
{
    /**
     * @param Product[] $products
     *
     * @return ProductResponseItemDTO[]
     */
    public function fromEntityListToResponseDtoList(array $products): array
    {
        $res = [];
        foreach ($products as $product) {
            $res[] = $this->fromEntityToResponseDto($product);
        }

        return $res;
    }

    public function fromEntityToResponseDto(Product $product): ProductResponseItemDTO
    {
        return new ProductResponseItemDTO(
            ulid: $product->getUlid(),
            name: $product->getName(),
            description: $product->getDescription(),
            price: $product->getPrice(),
            mainImage: $product->getMainImage(),
            images: $product->getImages(),
            creator: $product->getCreatorUlid()->getUlid(),
            categories: array_map(fn (Category $category) => new CategoryForProductResponseDTO($category->getName()), $product->getCategories()->toArray()),
            attributes: array_map(fn (Attribute $attribute) => new AttributeResponseDTO($attribute->getName(), $attribute->getValue()), $product->getAttributes()->toArray())
        );
    }
}
