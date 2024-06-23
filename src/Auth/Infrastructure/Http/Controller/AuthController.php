<?php

namespace App\Auth\Infrastructure\Http\Controller;

use App\Auth\Application\DTO\SingUpDTO;
use App\Auth\Application\UseCase\Command\SingUp\SingUpCommand;
use App\Shared\Application\Attribute\RequestBody;
use App\Shared\Application\DTO\ErrorResponse;
use App\Shared\Infrastructure\Bus\CommandBus;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Nelmio\ApiDocBundle\Annotation\Model;
use OpenApi\Attributes as OA;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthController extends AbstractController
{
    public function __construct(private readonly CommandBus $commandBus)
    {
    }

    #[OA\Response(response: 200, description: 'Signs up a user',
        content: new OA\JsonContent(properties: [
            new OA\Property(property: 'token', type: 'string'),
            new OA\Property(property: 'refresh_token', type: 'string')])
    )]
    #[OA\Response(response: 400, description: 'RequestBody validation failed', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\Response(response: 409, description: 'Email already exist', attachables: [new Model(type: ErrorResponse::class)])]
    #[OA\RequestBody(attachables: [new Model(type: SingUpDTO::class)])]
    #[Route(path: '/api/v1/testTask/singUp', methods: ['POST'])]
    public function singUp(#[RequestBody] SingUpDTO $singUpDTO): Response
    {
        $command = new SingUpCommand($singUpDTO);
        /**
         * @var JWTAuthenticationSuccessResponse $result
         */
        $result = $this->commandBus->execute($command);

        return $result;
    }
}
