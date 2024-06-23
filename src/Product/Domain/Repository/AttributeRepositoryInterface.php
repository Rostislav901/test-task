<?php

namespace App\Product\Domain\Repository;

use App\Product\Domain\Aggregate\Product\Entity\Attribute;
use App\Product\Domain\Aggregate\Product\Entity\Product;

interface AttributeRepositoryInterface
{
    public function persist(Attribute $attribute): void;

    public function removeByProductNotFlush(Product $product): void;
}
