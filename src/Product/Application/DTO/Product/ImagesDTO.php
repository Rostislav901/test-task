<?php

namespace App\Product\Application\DTO\Product;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class ImagesDTO
{
    /**
     * @var ImageItemDTO[] $images
     */
    #[SerializedName(serializedName: 'images')]
    #[NotBlank]
    #[Type('array')]
    #[All([new Type(type: ImageItemDTO::class)])]
    #[OA\Property(type: 'array', items: new OA\Items(ref: ImageItemDTO::class))]
    #[Valid]
    public array $images;

    /**
     * @param ImageItemDTO[] $images
     */
    public function __construct(array $images)
    {
        $this->images = $images;
    }
}
