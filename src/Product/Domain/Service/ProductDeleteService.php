<?php

namespace App\Product\Domain\Service;

use App\Product\Domain\Repository\ProductRepositoryInterface;

class ProductDeleteService
{
    public function __construct(private readonly ProductRepositoryInterface $productRepository)
    {
    }

    public function deleteProductByUlid(string $productUlid): void
    {
        $product = $this->productRepository->findOneByUlid($productUlid);

        $this->productRepository->removeNotFlush($product);

        $this->productRepository->flush();
    }
}
