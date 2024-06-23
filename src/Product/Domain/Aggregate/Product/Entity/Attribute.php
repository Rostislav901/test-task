<?php

namespace App\Product\Domain\Aggregate\Product\Entity;

use App\Product\Domain\Repository\AttributeRepositoryInterface;
use App\Shared\Domain\Service\UlidGenerator;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AttributeRepositoryInterface::class)]
#[ORM\Table(name: 'product_attribute')]
class Attribute
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'NONE')]
    #[ORM\Column(name: 'ulid', type: 'string', length: 26)]
    public string $ulid;
    #[ORM\Column(name: 'name', type: 'string', length: 32)]
    public string $name;
    #[ORM\Column(name: 'value', type: 'string', length: 255)]
    public string $value;
    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'attributes')]
    #[ORM\JoinColumn(name: 'product_ulid', referencedColumnName: 'ulid', nullable: false)]
    public Product $product;

    public function __construct(string $name, string $value, Product $product)
    {
        $this->ulid = UlidGenerator::generate();
        $this->name = $name;
        $this->value = $value;
        $this->product = $product;
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
        $this->name = $name;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }
}
