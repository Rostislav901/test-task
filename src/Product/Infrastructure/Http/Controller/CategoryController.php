<?php

namespace App\Product\Infrastructure\Http\Controller;

use App\Product\Application\DTO\Category\CategoriesResponseDTO;
use App\Product\Application\DTO\Category\CategoryIdDTO;
use App\Product\Application\DTO\Category\CategoryInsertDTO;
use App\Product\Application\DTO\Category\CategoryUpdateDTO;
use App\Product\Application\UseCase\Command\CreateCategory\CreateCategoryCommand;
use App\Product\Application\UseCase\Command\DeleteCategoryById\DeleteCategoryByIdCommand;
use App\Product\Application\UseCase\Command\UpdateCategoryById\UpdateCategoryCommand;
use App\Product\Application\UseCase\Query\GetAllCategory\GetAllCategoryQuery;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParameter;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\Query\QueryBusInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategoryController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus)
    {
    }

    #[OA\Response(response: 200, description: 'Success creating. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Category already exist', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Parent category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: CategoryInsertDTO::class)])]
    #[Route(path: '/api/v1/testTask/private/category/create', name: 'create_category', methods: ['POST'])]
    public function createCategory(#[RequestBody] CategoryInsertDTO $categoryRequestDTO): Response
    {
        $command = new CreateCategoryCommand($categoryRequestDTO);
        $this->commandBus->execute($command);

        return $this->json('success');
    }

    #[OA\Response(response: 200, description: 'Return all categories', attachables: [new Model(type: CategoriesResponseDTO::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Categories not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/testTask/private/category/read', name: 'read_category', methods: ['GET'])]
    public function readCategoryAll(): Response
    {
        $query = new GetAllCategoryQuery();
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Success update. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Parent category not found or Category by id not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Category already exist. Choose another category name', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 422, description: 'The parent category violates the program logic', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: CategoryUpdateDTO::class)])]
    #[OA\Parameter(name: 'id', description: 'categoryId', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))]
    #[Route(path: '/api/v1/testTask/private/category/update/{id}', name: 'update_category', methods: ['PUT'])]
    public function updateCategory(
        #[RequestParameter] CategoryIdDTO $categoryIdDTO,
        #[RequestBody] CategoryUpdateDTO $categoryUpdateDTO): Response
    {
        $updateCommand = new UpdateCategoryCommand($categoryIdDTO->id, $categoryUpdateDTO);

        $this->commandBus->execute($updateCommand);

        return $this->json('success');
    }

    #[OA\Response(response: 200, description: 'Success delete. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category by id not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Parameter(name: 'id', description: 'categoryId', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))]
    #[Route(path: '/api/v1/testTask/private/category/delete/{id}', name: 'delete_category', methods: ['DELETE'])]
    public function deleteCategoryById(#[RequestParameter] CategoryIdDTO $categoryIdDTO): Response
    {
        $delCommand = new DeleteCategoryByIdCommand($categoryIdDTO->id);

        $this->commandBus->execute($delCommand);

        return $this->json('success');
    }
}
