<?php

namespace App\Repository;

use App\Entity\Address;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Repository des adresses
 */
class AddressBookRepository
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
        $this->repository = $entityManager->getRepository(Address::class);
    }

    /**
     * @param Address $address
     *
     * @return Address
     */
    public function save(Address $address): Address
    {
        $this->entityManager->persist($address);
        $this->entityManager->flush();

        return $address;
    }

    /**
     * Recupere l'ensemble des adresses triés par nom, prénom, surnom
     *
     * @return array|Address[]
     */
    public function findAll(): array
    {
        return $this->repository->findBy(
            [],
            [
                'nom' => 'ASC',
                'prenom' => 'ASC',
                'surnom' => 'ASC',
            ]
        );
    }
}
