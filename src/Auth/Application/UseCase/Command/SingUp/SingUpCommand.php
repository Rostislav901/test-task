<?php

namespace App\Auth\Application\UseCase\Command\SingUp;

use App\Auth\Application\DTO\SingUpDTO;
use App\Shared\Application\Command\CommandInterface;

class SingUpCommand implements CommandInterface
{
    public function __construct(public SingUpDTO $userSingUpDTO)
    {
    }
}
