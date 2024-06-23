<?php

namespace App\Product\Application\UseCase\Command\DeleteCategoryById;

use App\Product\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\AuthFetcherInterface;

class DeleteCategoryByIdCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly CategoryRepositoryInterface $categoryRepository,
        private readonly AuthFetcherInterface $authFetcher)
    {
    }

    public function __invoke(DeleteCategoryByIdCommand $command): void
    {
        $categoryId = $command->categoryId;
        $category = $this->categoryRepository->findCategoryByIdAndAuthUlid(
            id: $categoryId,
            authUlid: $this->authFetcher->getAuth()->getUlid());

        $this->categoryRepository->removeNotFlushed($category);

        $this->categoryRepository->flush();
    }
}
