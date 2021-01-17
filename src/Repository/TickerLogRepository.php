<?php

namespace App\Repository;

use App\Entity\TickerLog;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * 
 */
class TickerLogRepository
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
        $this->repository = $entityManager->getRepository(TickerLog::class);
    }

    /**
     * @param TickerLog $tickerLog
     *
     * @return TickerLog
     */
    public function save(TickerLog $tickerLog): TickerLog
    {
        $this->entityManager->persist($tickerLog);
        $this->entityManager->flush();

        return $tickerLog;
    }
}