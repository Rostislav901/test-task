<?php

namespace App\Product\Application\DTO\Product;

class ProductResponseItemDTO
{
    public string $ulid;
    public string $name;
    public string $description;
    public float $price;
    public string $mainImage;
    public array $images;
    public string $creator;
    /**
     * @var CategoryForProductResponseDTO[]
     */
    public array $categories;

    public array $attributes;

    public function __construct(
        string $ulid, string $name, string $description, float $price,
        string $mainImage, array $images, string $creator, array $categories, array $attributes)
    {
        $this->ulid = $ulid;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->mainImage = $mainImage;
        $this->images = $images;
        $this->creator = $creator;
        $this->categories = $categories;
        $this->attributes = $attributes;
    }
}
