<?php

namespace App\Product\Domain\Aggregate\Product\Specification;

use App\Product\Domain\Aggregate\Product\Specification\Exception\ProductAlreadyExistException;
use App\Product\Domain\Repository\ProductRepositoryInterface;

class ProductNameSpecification
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    private function nameIsUnique(string $name, string $creatorUlid): void
    {
        true !== $this->productRepository->existByProductNameAndCreatorUlid($name, $creatorUlid) ?: throw new ProductAlreadyExistException();
    }

    public function satisfy(string $name, string $creatorUlid): void
    {
        $this->nameIsUnique($name, $creatorUlid);
    }
}
