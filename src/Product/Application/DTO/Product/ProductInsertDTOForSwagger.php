<?php

namespace App\Product\Application\DTO\Product;

use App\Product\Application\DTO\Attribute\AttributeItemDTO;
use App\Product\Application\DTO\Category\CategoryItemDTO;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class ProductInsertDTOForSwagger
{
    #[OA\Property(property: 'name', description: 'product name', type: 'string', example: 'example-product')]
    #[NotBlank]
    #[Length(max: 30)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $name;

    #[OA\Property(property: 'description', description: 'product description', type: 'string', example: 'example-product-description')]
    #[NotBlank]
    #[Length(max: 150)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $description;
    #[OA\Property(property: 'mainImage', description: 'mainImage link', type: 'string', example: 'example-mainImageLink.png')]
    #[NotBlank]
    #[Length(max: 120)]
    public string $mainImage;

    #[OA\Property(property: 'price', description: 'product price', type: 'float', example: 123)]
    #[NotBlank]
    #[Type(type: 'float', message: 'price must be float')]
    public float $price;

    /**
     * @var CategoryItemDTO[] $categories
     */
    #[SerializedName('categories')]
    #[NotBlank]
    #[Type(type: 'array')]
    #[All([new Type(type: CategoryItemDTO::class)])]
    #[Valid]
    public array $categories;

    /**
     * @var ImageItemDTO[] $images
     */
    #[SerializedName(serializedName: 'images')]
    #[NotBlank]
    #[Type('array')]
    #[All([new Type(type: ImageItemDTO::class)])]
    #[Valid]
    public array $images;

    /**
     * @var AttributeItemDTO[] $attributes
     */
    #[SerializedName(serializedName: 'attributes')]
    #[Type('array')]
    #[NotBlank]
    #[All([new Type(type: AttributeItemDTO::class)])]
    #[Valid]
    public array $attributes;

    /**
     * @param CategoryItemDTO[]  $categories
     * @param ImageItemDTO[]     $images
     * @param AttributeItemDTO[] $attributes
     */
    public function __construct(string $name, string $description, string $mainImage, float $price, array $categories, array $images, array $attributes)
    {
        $this->name = $name;
        $this->description = $description;
        $this->mainImage = $mainImage;
        $this->price = $price;
        $this->categories = $categories;
        $this->images = $images;
        $this->attributes = $attributes;
    }
}
