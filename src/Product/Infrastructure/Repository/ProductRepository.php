<?php

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Aggregate\Product\Entity\Product;
use App\Product\Domain\Exception\ProductNotFoundException;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository implements ProductRepositoryInterface
{
    private readonly EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function existByProductNameAndCreatorUlid(string $productName, string $creatorUlid): bool
    {
        return null !== $this->findOneBy(['name' => $productName, 'creatorUlid.ulid' => $creatorUlid]);
    }

    public function persist(Product $product): void
    {
        $this->entityManager->persist($product);
    }

    public function flush(): void
    {
        $this->entityManager->flush();
    }

    public function findByUlidAndCreatorUlid(string $productUlid, string $creatorUlid): Product
    {
        $product = $this->findOneBy(['ulid' => $productUlid, 'creatorUlid.ulid' => $creatorUlid]);

        return null === $product ? throw new ProductNotFoundException() : $product;
    }

    public function findOneByUlid(string $ulid): Product
    {
        $product = $this->findOneBy(['ulid' => $ulid]);

        return null === $product ? throw new ProductNotFoundException() : $product;
    }

    public function removeNotFlush(Product $product): void
    {
        $this->entityManager->remove($product);
    }

    public function getAll(): array
    {
        $products = $this->findAll();

        return [] === $products ? throw new ProductNotFoundException() : $products;
    }
}
