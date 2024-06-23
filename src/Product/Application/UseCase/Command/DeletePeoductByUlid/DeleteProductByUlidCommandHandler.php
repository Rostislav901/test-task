<?php

namespace App\Product\Application\UseCase\Command\DeletePeoductByUlid;

use App\Product\Domain\Service\ProductDeleteService;
use App\Shared\Application\Command\CommandHandlerInterface;

class DeleteProductByUlidCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly ProductDeleteService $deleteService)
    {
    }

    public function __invoke(DeleteProductByUlidCommand $command): void
    {
        $this->deleteService->deleteProductByUlid($command->productUlid);
    }
}
