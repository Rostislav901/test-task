<?php

namespace App\Product\Application\UseCase\Command\UpdateCategoryById;

use App\Product\Domain\Aggregate\Product\Category\Specification\RootCategorySpecification;
use App\Product\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\AuthFetcherInterface;

class UpdateCategoryCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $repository,
        private readonly RootCategorySpecification $rootCategorySpecification,
        private readonly AuthFetcherInterface $authFetcher)
    {
    }

    public function __invoke(UpdateCategoryCommand $updateCategoryCommand): void
    {
        $categoryData = $updateCategoryCommand->categoryUpdateDTO;
        $categoryId = $updateCategoryCommand->categoryId;
        $category = $this->repository->findCategoryByIdAndAuthUlid($categoryId, $this->authFetcher->getAuth()->getUlid());
        $category->setCategorySpecification($this->rootCategorySpecification);
        $newParentCategoryName = $categoryData->parent;

        if (null !== $newParentCategoryName) {
            $parent = 'null' === $newParentCategoryName ? null : $this->repository->findCategoryByName($newParentCategoryName);

            $category->setParent($parent);
        }

        if (null !== $categoryData->name) {
            $category->updateName($categoryData->name);
        }

        if (null !== $categoryData->description) {
            $category->setDescription($categoryData->description);
        }

        $this->repository->persist($category);

        $this->repository->flush();
    }
}
