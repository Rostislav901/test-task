<?php

namespace App\Auth\Application\UseCase\Command\SingUp;

use App\Auth\Domain\Service\AuthMaker;
use App\Shared\Application\Command\CommandHandlerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationSuccessResponse;
use Lexik\Bundle\JWTAuthenticationBundle\Security\Http\Authentication\AuthenticationSuccessHandler;
use Symfony\Component\HttpFoundation\Response;

class SingUpCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly AuthMaker $authMaker,
        private readonly AuthenticationSuccessHandler $authenticationSuccessHandler)
    {
    }

    public function __invoke(SingUpCommand $singUpCommand): JWTAuthenticationSuccessResponse|Response
    {
        $singUpData = $singUpCommand->userSingUpDTO;
        $addAuth = $this->authMaker->make($singUpData->email, $singUpData->password);

        return $this->authenticationSuccessHandler->handleAuthenticationSuccess($addAuth);
    }
}
