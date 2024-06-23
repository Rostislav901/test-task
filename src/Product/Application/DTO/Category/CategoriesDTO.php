<?php

namespace App\Product\Application\DTO\Category;

use OpenApi\Attributes as OA;
use Symfony\Component\Serializer\Attribute\SerializedName;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Valid;

class CategoriesDTO
{
    /**
     * @var CategoryItemDTO[] $categories
     */
    #[SerializedName('categories')]
    #[NotBlank]
    #[Type(type: 'array')]
    #[All([new Type(type: CategoryItemDTO::class)])]
    #[OA\Property(type: 'array', items: new OA\Items(ref: CategoryItemDTO::class))]
    #[Valid]
    public array $categories;

    /**
     * @param CategoryItemDTO[] $categories
     */
    public function __construct(array $categories)
    {
        $this->categories = $categories;
    }
}
