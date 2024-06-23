<?php

namespace App\Product\Domain\Factory;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Aggregate\Product\Category\Specification\RootCategorySpecification;
use App\Shared\Domain\Security\AuthFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\ValueObject\AuthUlid;

class CategoryFactory
{
    public function __construct(
        private readonly AuthFetcherInterface $authFetcher,
        private readonly UlidSpecification $ulidSpecification,
        private readonly RootCategorySpecification $rootCategorySpecification)
    {
    }

    public function create(string $name, string $description, ?Category $parent): Category
    {
        $category = new Category($this->rootCategorySpecification);

        $category->setName($name);
        $category->setDescription($description);
        $category->setCreatorUlid(
            new AuthUlid($this->authFetcher->getAuth()->getUlid(), $this->ulidSpecification));
        $category->setParent($parent);

        return $category;
    }
}
