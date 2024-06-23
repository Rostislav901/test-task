<?php

namespace App\Product\Domain\Aggregate\Product\Category\Entity;

use App\Product\Domain\Aggregate\Product\Category\Specification\RootCategorySpecification;
use App\Product\Domain\Repository\CategoryRepositoryInterface;
use App\Shared\Domain\ValueObject\AuthUlid;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[Gedmo\Tree(type: 'nested')]
#[ORM\Table(name: 'product_category')]
#[ORM\Entity(repositoryClass: CategoryRepositoryInterface::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: Types::INTEGER)]
    private int $id;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 64)]
    private string $name;
    #[ORM\Column(name: 'description', type: Types::STRING, length: 512)]
    private string $description;
    #[ORM\Embedded(class: AuthUlid::class)]
    private AuthUlid $creatorUlid;
    #[Gedmo\TreeLeft]
    #[ORM\Column(name: 'lft', type: Types::INTEGER, )]
    private int $lft;

    #[Gedmo\TreeLevel]
    #[ORM\Column(name: 'lvl', type: Types::INTEGER, )]
    private int $lvl;

    #[Gedmo\TreeRight]
    #[ORM\Column(name: 'rgt', type: Types::INTEGER, )]
    private int $rgt;

    #[Gedmo\TreeRoot]
    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'tree_root', referencedColumnName: 'id', onDelete: 'CASCADE')]
    private Category $root;

    #[Gedmo\TreeParent]
    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'children')]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    private ?Category $parent = null;

    #[ORM\OneToMany(targetEntity: Category::class, mappedBy: 'parent')]
    #[ORM\OrderBy(['lft' => 'ASC'])]
    private Collection $children;

    public function __construct(private RootCategorySpecification $categorySpecification)
    {
    }

    public function setCategorySpecification(RootCategorySpecification $categorySpecification): void
    {
        $this->categorySpecification = $categorySpecification;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->categorySpecification->getCategoryNameSpecification()->satisfy($name);
        $this->name = $name;
    }

    public function updateName(string $name): void
    {
        if ($name !== $this->name) {
            $this->categorySpecification->getCategoryNameSpecification()->satisfy($name);
        }
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

    public function getCreatorUlid(): string
    {
        return $this->creatorUlid->getUlid();
    }

    public function setCreatorUlid(AuthUlid $creatorUlid): void
    {
        $this->creatorUlid = $creatorUlid;
    }

    public function getRoot(): ?self
    {
        return $this->root;
    }

    public function setParent(?self $parent = null): void
    {
        if (null !== $parent) {
            $this->categorySpecification->getCategoryParentSpecification()->parentExists($parent);
            $this->categorySpecification->getCategoryParentSpecification()->childNotParent($parent, $this);
        }
        $this->parent = $parent;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function getLft(): int
    {
        return $this->lft;
    }

    public function setLft(int $lft): self
    {
        $this->lft = $lft;

        return $this;
    }

    public function getLvl(): int
    {
        return $this->lvl;
    }

    public function setLvl(int $lvl): self
    {
        $this->lvl = $lvl;

        return $this;
    }

    public function getRgt(): int
    {
        return $this->rgt;
    }

    public function setRgt(int $rgt): self
    {
        $this->rgt = $rgt;

        return $this;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function setChildren(Collection $children): self
    {
        $this->children = $children;

        return $this;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setRoot(Category $root): void
    {
        $this->root = $root;
    }
}
