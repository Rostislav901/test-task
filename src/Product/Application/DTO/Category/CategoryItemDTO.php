<?php

namespace App\Product\Application\DTO\Category;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryItemDTO
{
    #[OA\Property(property: 'category', description: 'existing category name', type: 'string', example: 'example-exist-category')]
    #[NotBlank]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $category;

    public function __construct(string $category)
    {
        $this->category = $category;
    }
}
