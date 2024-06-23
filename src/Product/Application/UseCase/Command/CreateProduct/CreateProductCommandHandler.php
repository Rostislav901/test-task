<?php

namespace App\Product\Application\UseCase\Command\CreateProduct;

use App\Product\Application\Service\ProductMainFormatMapService;
use App\Product\Application\Transformer\AttributesTransformer;
use App\Product\Domain\Factory\ProductFactory;
use App\Product\Domain\Repository\AttributeRepositoryInterface;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

class CreateProductCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductFactory $productFactory,
        private readonly ProductRepositoryInterface $productRepository,
        private readonly AttributesTransformer $attributesTransformer,
        private readonly ProductMainFormatMapService $productMainFormatMapService,
        private readonly AttributeRepositoryInterface $attributeRepository)
    {
    }

    public function __invoke(CreateProductCommand $createProductCommand): void
    {
        $productData = $createProductCommand->productRequestDTO;

        $categories = $this->productMainFormatMapService->getCategoryMapService()
            ->mapCategoryInEntity($createProductCommand->categoriesDTO->categories);

        $images = $this->productMainFormatMapService->getImageMapService()
            ->mapImageToProductFormat($createProductCommand->imagesDTO->images);

        $attributes = $createProductCommand->attributesDTO->attributes;

        $product = $this->productFactory->create(
            name: $productData->name,
            description: $productData->description,
            mainImage: $productData->mainImage,
            images: $images,
            categories: $categories,
            price: $productData->price
        );

        $this->productRepository->persist($product);

        $attributesEntity = $this->attributesTransformer->fromDtoListRoEntityList($attributes, $product);

        foreach ($attributesEntity as $attribute) {
            $this->attributeRepository->persist($attribute);
        }

        $this->productRepository->flush();
    }
}
