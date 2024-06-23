<?php

namespace App\Product\Application\DTO\Product;

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Type;

class ProductInsertDTO
{
    #[NotBlank]
    #[Length(max: 30)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $name;
    #[NotBlank]
    #[Length(max: 150)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $description;
    #[NotBlank]
    #[Length(max: 120)]
    public string $mainImage;
    #[NotBlank]
    #[Type(type: 'float', message: 'price must be float')]
    public float $price;

    public function __construct(string $name, string $description, string $mainImage, float $price)
    {
        $this->name = $name;
        $this->description = $description;
        $this->mainImage = $mainImage;
        $this->price = $price;
    }
}
