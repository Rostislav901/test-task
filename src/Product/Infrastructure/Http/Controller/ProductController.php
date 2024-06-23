<?php

namespace App\Product\Infrastructure\Http\Controller;

use App\Product\Application\DTO\Attribute\AttributesDTO;
use App\Product\Application\DTO\Category\CategoriesDTO;
use App\Product\Application\DTO\Product\ImagesDTO;
use App\Product\Application\DTO\Product\ProductInsertDTO;
use App\Product\Application\DTO\Product\ProductInsertDTOForSwagger;
use App\Product\Application\DTO\Product\ProductsResponseDTO;
use App\Product\Application\DTO\Product\ProductUpdateDTO;
use App\Product\Application\UseCase\Command\CreateProduct\CreateProductCommand;
use App\Product\Application\UseCase\Command\DeletePeoductByUlid\DeleteProductByUlidCommand;
use App\Product\Application\UseCase\Command\UpdateProductByUlid\UpdateProductByUlidCommand;
use App\Product\Application\UseCase\Query\GetAllProduct\GetAllProductQuery;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\Attribute\RequestParameter;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Application\DTO\UlidDTO;
use App\Shared\Application\Query\QueryBusInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus)
    {
    }

    #[OA\Response(response: 200, description: 'Success creating. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Product already exist on you acc. Choose another product name', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: ProductInsertDTOForSwagger::class)])]
    #[Route(path: '/api/v1/testTask/private/product/create', methods: ['POST'])]
    public function createProduct(
        #[RequestBody] ProductInsertDTO $productRequestDTO,
        #[RequestBody] CategoriesDTO $categoriesDTO,
        #[RequestBody] ImagesDTO $imagesDTO,
        #[RequestBody] AttributesDTO $attributesDTO): Response
    {
        $command = new CreateProductCommand($productRequestDTO, $categoriesDTO, $imagesDTO, $attributesDTO);
        $this->commandBus->execute($command);

        return $this->json('success');
    }

    #[OA\Response(response: 200, description: 'Return all products', attachables: [new Model(type: ProductsResponseDTO::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Products not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[Route(path: '/api/v1/testTask/private/product/read', methods: ['GET'])]
    public function readProductAll(): Response
    {
        $query = new GetAllProductQuery();
        /**
         * @var ProductsResponseDTO $result
         */
        $result = $this->queryBus->execute($query);

        return $this->json($result);
    }

    #[OA\Response(response: 200, description: 'Success update. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Category not found or Product by ulid not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Product already exist. Choose another product name', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Parameter(name: 'ulid', description: 'productUlid', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))]
    #[OA\RequestBody(attachables: [new Model(type: ProductUpdateDTO::class)])]
    #[Route(path: '/api/v1/testTask/private/product/update/{ulid}', methods: ['PUT'])]
    public function updateProductByUlid(
        #[RequestParameter] UlidDTO $productUlid,
        #[RequestBody] ProductUpdateDTO $productUpdateDTO): Response
    {
        $updateCommand = new UpdateProductByUlidCommand($productUpdateDTO, $productUlid);

        $this->commandBus->execute($updateCommand);

        return $this->json('success');
    }

    #[OA\Response(response: 200, description: 'Success delete. Return success message')]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 401, description: 'Authorization was failed. Check you token.', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 404, description: 'Product by ulid not found', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Parameter(name: 'ulid', description: 'productUlid', in: 'path', required: true, schema: new OA\Schema(type: 'integer'))]
    #[Route(path: '/api/v1/testTask/private/product/delete/{ulid}', methods: ['DELETE'])]
    public function deleteProductByUlid(#[RequestParameter] UlidDTO $productUlid): Response
    {
        $deleteCommand = new DeleteProductByUlidCommand($productUlid->ulid);

        $this->commandBus->execute($deleteCommand);

        return $this->json('success');
    }
}
