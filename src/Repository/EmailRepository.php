<?php

namespace App\Repository;

use App\Entity\Email;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Repository des adresses
 */
class EmailRepository
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
        $this->repository = $entityManager->getRepository(Email::class);
    }

    /**
     * @param Email $address
     *
     * @return Email
     */
    public function save(Email $email): Email
    {
        $this->entityManager->persist($email);
        $this->entityManager->flush();

        return $email;
    }

    /**
     * @param string $email
     * @param \DateTime $date
     */
    public function findByEmailAndDate(string $email, \DateTime $date)
    {
        return $this->repository->findBy(
            [
                "from" => $email,
                "date" => $date
            ]
        );
    }
}