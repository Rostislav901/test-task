<?php

namespace App\Product\Application\DTO\Attribute;

use OpenApi\Attributes as OA;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class AttributeItemDTO
{
    #[OA\Property(property: 'name', description: 'attribute name', type: 'string', example: 'example-attribute-name')]
    #[NotBlank]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $name;

    #[OA\Property(property: 'value', description: 'attribute value', type: 'string', example: 'example-attribute-value')]
    #[Length(min: 3, max: 64)]
    #[Regex(pattern: '/^[a-zA-Z0-9-_ .,!?\\s]{3,}$/')]
    public string $value;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }
}
