<?php

namespace App\Shared\Infrastructure\Security;

use App\Shared\Domain\Security\AuthFetcherInterface;
use App\Shared\Domain\Security\AuthInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Webmozart\Assert\Assert;

class AuthFetcher implements AuthFetcherInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function getAuth(): AuthInterface
    {
        /**
         * @var AuthInterface $user
         */
        $user = $this->security->getUser();

        Assert::notNull($user, 'Auth not found');
        Assert::isInstanceOf($user, AuthInterface::class, 'Type Not instance ');

        return $user;
    }
}
