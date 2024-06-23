<?php

namespace App\Product\Infrastructure\Repository;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Exception\CategoryNotFoundException;
use App\Product\Domain\Repository\CategoryRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Gedmo\Tree\Entity\Repository\NestedTreeRepository;

class CategoryRepository extends NestedTreeRepository implements CategoryRepositoryInterface
{
    private readonly EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, new ClassMetadata(Category::class));
        $this->em = $em;
    }

    public function add(Category $category): void
    {
        $this->em->persist($category);
        $this->em->flush();
    }

    public function findCategoryByName(string $categoryName): Category
    {
        $category = $this->findOneBy(['name' => $categoryName]);

        return null === $category ? throw new CategoryNotFoundException() : $category;
    }

    public function existByName(string $name): bool
    {
        return null !== $this->findOneBy(['name' => $name]);
    }

    public function getChildCategory(Category $category): array
    {
        return $this->children($category);
    }

    public function getAllCategories(): array
    {
        $categories = $this->findAll();

        return [] === $categories ? throw new CategoryNotFoundException() : $categories;
    }

    public function findCategoryByIdAndAuthUlid(int $id, string $authUlid): Category
    {
        $category = $this->findOneBy(['id' => $id, 'creatorUlid.ulid' => $authUlid]);

        return null === $category ? throw new CategoryNotFoundException() : $category;
    }

    public function persist(Category $category): void
    {
        $this->em->persist($category);
    }

    public function flush(): void
    {
        $this->em->flush();
    }

    public function removeNotFlushed(Category $category): void
    {
        $this->em->remove($category);
    }
}
