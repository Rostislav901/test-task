<?php

namespace App\Product\Domain\Factory;

use App\Product\Domain\Aggregate\Product\Entity\Attribute;
use App\Product\Domain\Aggregate\Product\Entity\Product;

class AttributeFactory
{
    public function create(string $name, string $value, Product $product): Attribute
    {
        return new Attribute($name, $value, $product);
    }
}
