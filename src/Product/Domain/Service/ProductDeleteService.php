<?php

namespace App\Product\Domain\Service;

use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Security\AuthFetcherInterface;

class ProductDeleteService
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly AuthFetcherInterface $authFetcher)
    {
    }

    public function deleteProductByUlid(string $productUlid): void
    {
        $product = $this->productRepository->findByUlidAndCreatorUlid($productUlid, $this->authFetcher->getAuth()->getUlid());

        $this->productRepository->removeNotFlush($product);

        $this->productRepository->flush();
    }
}
