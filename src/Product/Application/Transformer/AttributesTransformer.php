<?php

namespace App\Product\Application\Transformer;

use App\Product\Application\DTO\Attribute\AttributeItemDTO;
use App\Product\Domain\Aggregate\Product\Entity\Attribute;
use App\Product\Domain\Aggregate\Product\Entity\Product;
use App\Product\Domain\Factory\AttributeFactory;

class AttributesTransformer
{
    public function __construct(private readonly AttributeFactory $attributeFactory)
    {
    }

    /**
     * @param AttributeItemDTO[] $dtoList
     *
     * @return Attribute[]
     */
    public function fromDtoListRoEntityList(array $dtoList, Product $product): array
    {
        $attributes = [];
        foreach ($dtoList as $dto) {
            $attributes[] = $this->fromDtoToEntity($dto, $product);
        }

        return $attributes;
    }

    public function fromDtoToEntity(AttributeItemDTO $attributeItemDTO, Product $product): Attribute
    {
        return $this->attributeFactory->create($attributeItemDTO->name, $attributeItemDTO->value, $product);
    }
}
