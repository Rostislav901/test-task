<?php

namespace App\Product\Domain\Aggregate\Product\Category\Specification;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Aggregate\Product\Category\Specification\Exception\ChildCanNotBeParentException;
use App\Product\Domain\Aggregate\Product\Category\Specification\Exception\ParentCanNotBeSelfException;
use App\Product\Domain\Exception\CategoryNotFoundException;
use App\Product\Domain\Repository\CategoryRepositoryInterface;

class CategoryParentSpecification
{
    public function __construct(private readonly CategoryRepositoryInterface $categoryRepository)
    {
    }

    public function parentExists(Category $category): void
    {
        true === $this->categoryRepository->existByName($category->getName()) ?: throw new CategoryNotFoundException();
    }

    public function childNotParent(Category $potentialParent, Category $child): void
    {
        if (true === $this->categoryRepository->existByName($child->getName())) {
            if ($potentialParent === $child) {
                throw new ParentCanNotBeSelfException();
            }

            $children = $this->categoryRepository->getChildCategory($child);

            foreach ($children as $child) {
                if ($child === $potentialParent) {
                    throw new ChildCanNotBeParentException();
                }
            }
        }
    }
}
