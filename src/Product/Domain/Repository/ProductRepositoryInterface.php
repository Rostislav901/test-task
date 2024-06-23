<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Aggregate\Product\Entity\Product;

interface ProductRepositoryInterface
{
    public function findByUlidAndCreatorUlid(string $productUlid, string $creatorUlid): Product;

    public function existByProductNameAndCreatorUlid(string $productName, string $creatorUlid): bool;

    public function persist(Product $product): void;

    public function flush(): void;

    public function findOneByUlid(string $ulid): Product;

    public function removeNotFlush(Product $product): void;

    /**
     * @return Product[]
     */
    public function getAll(): array;
}
