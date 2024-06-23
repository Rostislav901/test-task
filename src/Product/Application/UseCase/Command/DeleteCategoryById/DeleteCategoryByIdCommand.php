<?php

namespace App\Product\Application\UseCase\Command\DeleteCategoryById;

use App\Shared\Application\Command\CommandInterface;

class DeleteCategoryByIdCommand implements CommandInterface
{
    public function __construct(public int $categoryId)
    {
    }
}
