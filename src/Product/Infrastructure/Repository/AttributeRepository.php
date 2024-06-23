<?php

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Aggregate\Product\Entity\Attribute;
use App\Product\Domain\Aggregate\Product\Entity\Product;
use App\Product\Domain\Repository\AttributeRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class AttributeRepository extends ServiceEntityRepository implements AttributeRepositoryInterface
{
    private readonly EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribute::class);
        $this->entityManager = $this->getEntityManager();
    }

    public function persist(Attribute $attribute): void
    {
        $this->entityManager->persist($attribute);
    }

    public function removeByProductNotFlush(Product $product): void
    {
        $attributes = $this->findBy(['product' => $product]);

        foreach ($attributes as $attribute) {
            $this->entityManager->remove($attribute);
        }
    }
}
