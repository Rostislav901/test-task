<?php

namespace App\Product\Application\DTO\Attribute;

use App\Product\Application\DTO\Product\ImageItemDTO;
use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class AttributesDTO
{
    /**
     * @var AttributeItemDTO[] $attributes
     */
    #[SerializedName(serializedName: 'attributes')]
    #[Type('array')]
    #[NotBlank]
    #[All([new Type(type: AttributeItemDTO::class)])]
    #[OA\Property(type: 'array', items: new OA\Items(ref: ImageItemDTO::class))]
    #[Valid]
    public array $attributes;

    /**
     * @param AttributeItemDTO[] $attributes
     */
    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
