<?php

namespace App\Product\Application\DTO\Category;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;

class CategoryUpdateDTO
{
    #[OA\Property(property: 'name', description: 'category', type: 'string', example: 'example-category', nullable: true)]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public ?string $name = null;

    #[OA\Property(property: 'description', description: 'category description', type: 'string', example: 'example-description', nullable: true)]
    #[Length(min: 3, max: 512)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public ?string $description = null;

    #[OA\Property(property: 'parent', description: 'name of existing category that is not child of self. Use string  \'null\' if you wont to clean parent category ', type: 'string', example: 'example-category', nullable: true)]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public ?string $parent = null;

    public function __construct(?string $name, ?string $description, ?string $parent)
    {
        $this->name = $name;
        $this->description = $description;
        $this->parent = $parent;
    }
}
