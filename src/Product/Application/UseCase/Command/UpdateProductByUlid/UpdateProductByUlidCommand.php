<?php

namespace App\Product\Application\UseCase\Command\UpdateProductByUlid;

use App\Product\Application\DTO\Product\ProductUpdateDTO;
use App\Shared\Application\Command\CommandInterface;
use App\Shared\Application\DTO\UlidDTO;

class UpdateProductByUlidCommand implements CommandInterface
{
    public function __construct(public readonly ProductUpdateDTO $updateProduct, public readonly UlidDTO $productUlid)
    {
    }
}
