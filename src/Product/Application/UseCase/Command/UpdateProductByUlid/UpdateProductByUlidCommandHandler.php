<?php

namespace App\Product\Application\UseCase\Command\UpdateProductByUlid;

use App\Product\Application\Service\ProductMainFormatMapService;
use App\Product\Application\Transformer\AttributesTransformer;
use App\Product\Domain\Aggregate\Product\Entity\Product;
use App\Product\Domain\Aggregate\Product\Specification\RootProductSpecification;
use App\Product\Domain\Repository\AttributeRepositoryInterface;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Security\AuthFetcherInterface;
use Doctrine\Common\Collections\ArrayCollection;

class UpdateProductByUlidCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly ProductRepositoryInterface $productRepository,
        private readonly ProductMainFormatMapService $productMainFormatMapService,
        private readonly AttributeRepositoryInterface $attributeRepository,
        private readonly RootProductSpecification $rootProductSpecification,
        private readonly AttributesTransformer $attributesTransformer,
        private readonly AuthFetcherInterface $authFetcher)
    {
    }

    public function __invoke(UpdateProductByUlidCommand $command): void
    {
        $product = $this->productRepository->findByUlidAndCreatorUlid(
            productUlid: $command->productUlid->ulid,
            creatorUlid: $this->authFetcher->getAuth()->getUlid()
        );
        $product->setRootProductSpecification($this->rootProductSpecification);
        $updateData = $command->updateProduct;

        $this->updateProductFields($product, $updateData);
        $this->productRepository->persist($product);
        $this->productRepository->flush();
    }

    private function updateProductFields(Product $product, $updateData): void
    {
        $product->setName($updateData->name ?? $product->getName());
        $product->setDescription($updateData->description ?? $product->getDescription());
        $product->setPrice($updateData->price ?? $product->getPrice());
        $product->setMainImage($updateData->mainImage ?? $product->getMainImage());

        if (null !== $updateData->categories) {
            $product->setCategories(
                new ArrayCollection(
                    $this->productMainFormatMapService->getCategoryMapService()
                        ->mapCategoryInEntity($updateData->categories)
                )
            );
        }

        if (null !== $updateData->images) {
            $product->setImages(
                $this->productMainFormatMapService->getImageMapService()
                    ->mapImageToProductFormat($updateData->images)
            );
        }

        if (null !== $updateData->attributes) {
            $attributesEntity = $this->attributesTransformer->fromDtoListRoEntityList($updateData->attributes, $product);

            $this->attributeRepository->removeByProductNotFlush($product);

            $product->setAttributes(new ArrayCollection($attributesEntity));
        }
    }
}
