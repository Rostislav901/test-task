<?php

namespace App\Product\Application\DTO\Product;

use App\Product\Application\DTO\Attribute\AttributeItemDTO;
use App\Product\Application\DTO\Category\CategoryItemDTO;
use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class ProductUpdateDTO
{
    #[OA\Property(property: 'name', description: 'product name', type: 'string', example: 'example-product', nullable: true)]
    #[Length(min: 5, max: 30)]
    public ?string $name = null;

    #[OA\Property(property: 'description', description: 'product description', type: 'string', example: 'example-product-description', nullable: true)]
    #[Length(min: 5, max: 150)]
    public ?string $description = null;
    #[OA\Property(property: 'price', description: 'product price', type: 'float', example: 123, nullable: true)]
    public ?float $price = null;
    #[OA\Property(property: 'mainImage', description: 'mainImage link', type: 'string', example: 'example-mainImageLink.png', nullable: true)]
    #[Length(min: 5, max: 150)]
    public ?string $mainImage = null;
    /**
     * @var ImageItemDTO[]|null $images
     */
    #[Type(type: ['array', 'null'])]
    #[All([new Type(type: ImageItemDTO::class)])]
    #[Valid]
    public ?array $images = null;
    /**
     * @var CategoryItemDTO[]|null $categories
     */
    #[Type(type: ['array', 'null'])]
    #[All([new Type(type: CategoryItemDTO::class)])]
    #[Valid]
    public ?array $categories = null;
    /**
     * @var AttributeItemDTO[]|null $attributes
     */
    #[Type(type: ['array', 'null'])]
    #[All([new Type(type: AttributeItemDTO::class)])]
    #[Valid]
    public ?array $attributes = null;

    public function __construct(?string $name, ?string $description, ?float $price, ?string $mainImage, ?array $images, ?array $categories, ?array $attributes)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->mainImage = $mainImage;
        $this->images = $images;
        $this->categories = $categories;
        $this->attributes = $attributes;
    }
}
