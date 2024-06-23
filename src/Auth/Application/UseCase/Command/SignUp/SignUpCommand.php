<?php

namespace App\Auth\Application\UseCase\Command\SignUp;

use App\Auth\Application\DTO\SignUpDTO;
use App\Shared\Application\Command\CommandInterface;

class SignUpCommand implements CommandInterface
{
    public function __construct(public SignUpDTO $userSingUpDTO)
    {
    }
}
