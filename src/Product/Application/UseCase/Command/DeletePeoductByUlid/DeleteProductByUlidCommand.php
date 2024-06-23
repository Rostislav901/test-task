<?php

namespace App\Product\Application\UseCase\Command\DeletePeoductByUlid;

use App\Shared\Application\Command\CommandInterface;

class DeleteProductByUlidCommand implements CommandInterface
{
    public function __construct(public readonly string $productUlid)
    {
    }
}
