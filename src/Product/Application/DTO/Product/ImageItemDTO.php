<?php

namespace App\Product\Application\DTO\Product;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ImageItemDTO
{
    #[OA\Property(property: 'image', description: 'image-link to product', type: 'string', example: 'example-image-link')]
    #[NotBlank]
    #[Length(max: 100)]
    public string $image;

    public function __construct(string $image)
    {
        $this->image = $image;
    }
}
