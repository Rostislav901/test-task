<?php

namespace App\Product\Application\UseCase\Query\GetAllProduct;

use App\Product\Application\DTO\Product\ProductsResponseDTO;
use App\Product\Application\Transformer\ProductTransformer;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

class GetAllProductQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        public ProductRepositoryInterface $productRepository,
        private readonly ProductTransformer $productTransformer)
    {
    }

    public function __invoke(GetAllProductQuery $query): ProductsResponseDTO
    {
        $products = $this->productRepository->getAll();

        return new ProductsResponseDTO($this->productTransformer->fromEntityListToResponseDtoList($products));
    }
}
