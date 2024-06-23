<?php

namespace App\Product\Application\UseCase\Command\CreateCategory;

use App\Product\Domain\Service\CategoryMaker;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly CategoryMaker $categoryMaker)
    {
    }

    public function __invoke(CreateCategoryCommand $command): void
    {
        $categoryData = $command->categoryRequestDTO;

        $this->categoryMaker->make(
            name: $categoryData->name,
            description: $categoryData->description,
            parent: $categoryData->parentCategory
        );
    }
}
