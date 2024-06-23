<?php

namespace App\Product\Application\UseCase\Command\CreateCategory;

use App\Product\Application\DTO\Category\CategoryInsertDTO;
use App\Shared\Application\Command\CommandInterface;

class CreateCategoryCommand implements CommandInterface
{
    public function __construct(public CategoryInsertDTO $categoryRequestDTO)
    {
    }
}
