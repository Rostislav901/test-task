<?php

namespace App\Product\Application\UseCase\Command\UpdateCategoryById;

use App\Product\Application\DTO\Category\CategoryUpdateDTO;
use App\Shared\Application\Command\CommandInterface;

class UpdateCategoryCommand implements CommandInterface
{
    public function __construct(
        public readonly string $categoryId,
        public readonly CategoryUpdateDTO $categoryUpdateDTO)
    {
    }
}
