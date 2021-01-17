<?php

namespace App\Repository;

use App\Entity\Tick;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * 
 */
class TickRepository
{
     /**
     * @var EntityRepository
     */
    private $repository;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Tick::class);
    }

    /**
     * @param int $hour
     *
     * @return Tick|null
     */
    public function findByHour(int $hour): ?Tick
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('t')
            ->from(Tick::class, 't')
            ->where('t.triggerHour = :hour')
            ->setParameter('hour', $hour);

        return $queryBuilder->getQuery()->getOneOrNullResult();
    }
}