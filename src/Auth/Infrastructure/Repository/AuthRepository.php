<?php

namespace App\Auth\Infrastructure\Repository;

use App\Auth\Domain\Aggregate\Auth\Entity\Auth;
use App\Auth\Domain\Repository\AuthRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class AuthRepository extends ServiceEntityRepository implements AuthRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Auth::class);

        $this->entityManager = $this->getEntityManager();
    }

    public function existByEmail(string $email): bool
    {
        return null !== $this->findOneBy(['email.email' => $email]);
    }

    public function add(Auth $auth): void
    {
        $this->entityManager->persist($auth);
        $this->entityManager->flush();
    }
}
