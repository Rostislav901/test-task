<?php

namespace App\Product\Domain\Factory;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Aggregate\Product\Entity\Product;
use App\Product\Domain\Aggregate\Product\Specification\RootProductSpecification;
use App\Shared\Domain\Security\AuthFetcherInterface;
use App\Shared\Domain\Specification\UlidSpecification;
use App\Shared\Domain\ValueObject\AuthUlid;
use Doctrine\Common\Collections\ArrayCollection;

class ProductFactory
{
    public function __construct(
        private readonly RootProductSpecification $rootProductSpecification,
        private readonly UlidSpecification $ulidSpecification,
        private readonly AuthFetcherInterface $authFetcher)
    {
    }

    /**
     * @param Category[] $categories
     */
    public function create(
        string $name, string $description, string $mainImage,
        array $images, array $categories, float $price): Product
    {
        $creatorUlid = $this->authFetcher->getAuth()->getUlid();
        $product = new Product(
            description: $description, name: $name,
            price: $price, mainImage: $mainImage,
            images: $images, creatorUlid: new AuthUlid($creatorUlid, $this->ulidSpecification),
            rootProductSpecification: $this->rootProductSpecification
        );

        $product->setCategories(new ArrayCollection($categories));

        return $product;
    }
}
