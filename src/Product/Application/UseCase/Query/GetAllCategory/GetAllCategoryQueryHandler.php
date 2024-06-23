<?php

namespace App\Product\Application\UseCase\Query\GetAllCategory;

use App\Product\Application\DTO\Category\CategoriesResponseDTO;
use App\Product\Application\Transformer\CategoryTransformer;
use App\Product\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetAllCategoryQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly CategoryTransformer $categoryTransformer)
    {
    }

    public function __invoke(GetAllCategoryQuery $query): CategoriesResponseDTO
    {
        $categories = $this->categoryRepository->getAllCategories();

        return new CategoriesResponseDTO($this->categoryTransformer->fromEntityListToResponseListDto($categories));
    }
}
