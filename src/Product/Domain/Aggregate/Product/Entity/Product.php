<?php

namespace App\Product\Domain\Aggregate\Product\Entity;

use App\Product\Domain\Aggregate\Product\Category\Entity\Category;
use App\Product\Domain\Aggregate\Product\Specification\RootProductSpecification;
use App\Product\Domain\Repository\ProductRepositoryInterface;
use App\Shared\Domain\Service\UlidGenerator;
use App\Shared\Domain\ValueObject\AuthUlid;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepositoryInterface::class)]
#[ORM\Table(name: 'product_product')]
class Product
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(name: 'ulid', type: 'string', length: 26)]
    public string $ulid;

    #[ORM\Column(name: 'name', type: 'string', length: 64)]
    public string $name;
    #[ORM\Column(name: 'description', type: 'string', length: 255)]
    public string $description;
    #[ORM\Column(name: 'price', type: 'decimal', precision: 6, scale: 2)]
    public float $price;
    #[ORM\Column(type: 'string', length: 255)]
    public string $mainImage;

    #[ORM\Column(type: Types::JSON, length: 255)]
    public array $images;
    #[ORM\Embedded(class: AuthUlid::class)]
    public AuthUlid $creatorUlid;

    #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'products', cascade: ['persist', 'remove'])]
    #[ORM\JoinTable(name: 'product_category_to_product')]
    #[ORM\JoinColumn(name: 'product_ulid', referencedColumnName: 'ulid')]
    public Collection $categories;
    #[ORM\OneToMany(targetEntity: Attribute::class, mappedBy: 'product', cascade: ['persist', 'remove'])]
    public Collection $attributes;

    public function __construct(string $description, string $name,
        float $price, string $mainImage,
        array $images, AuthUlid $creatorUlid,
        private RootProductSpecification $rootProductSpecification
    ) {
        $this->rootProductSpecification->getProductNameSpecification()->satisfy($name, $creatorUlid->getUlid());
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->mainImage = $mainImage;
        $this->images = $images;
        $this->creatorUlid = $creatorUlid;
        $this->ulid = UlidGenerator::generate();
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }

    public function setUlid(string $ulid): void
    {
        $this->ulid = $ulid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->rootProductSpecification->getProductNameSpecification()->satisfy($name, $this->creatorUlid->getUlid());
        $this->name = $name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getMainImage(): string
    {
        return $this->mainImage;
    }

    public function setMainImage(string $mainImage): void
    {
        $this->mainImage = $mainImage;
    }

    public function getImages(): array
    {
        return $this->images;
    }

    public function setImages(array $images): void
    {
        $this->images = $images;
    }

    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function setCategories(Collection $categories): void
    {
        $this->categories = $categories;
    }

    public function getCreatorUlid(): AuthUlid
    {
        return $this->creatorUlid;
    }

    public function setCreatorUlid(AuthUlid $creatorUlid): void
    {
        $this->creatorUlid = $creatorUlid;
    }

    public function getAttributes(): Collection
    {
        return $this->attributes;
    }

    public function setAttributes(Collection $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function setRootProductSpecification(RootProductSpecification $rootProductSpecification): void
    {
        $this->rootProductSpecification = $rootProductSpecification;
    }
}
