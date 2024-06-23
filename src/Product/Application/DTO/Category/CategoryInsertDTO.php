<?php

namespace App\Product\Application\DTO\Category;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryInsertDTO
{
    #[OA\Property(property: 'name', description: 'category', type: 'string', example: 'example-category')]
    #[NotBlank]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $name;

    #[OA\Property(property: 'description', description: 'category description', type: 'string', example: 'example-description')]
    #[NotBlank]
    #[Length(min: 3, max: 512)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $description;
    #[OA\Property(property: 'parentCategory', description: 'name of existing category', type: 'string', example: 'example-category', nullable: true)]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public ?string $parentCategory = null;
}
