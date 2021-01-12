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
     * Constructeur, injection des dépendances
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Address::class);
    }

    /**
     * Persiste une addresse en BDD
     *
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

    /**
     * Retourne les addresses correspondant a l'email
     *
     * @param string $email
     *
     * @return Address|null
     */
    public function findByEmail(string $email): ?Address
    {
        return $this->repository->findOneBy(['email' => $email]);
    }

    /**
     * @param string $searchString
     *
     * @return array
     */
    public function search(string $searchString): array
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
        $queryBuilder
            ->select('a')
            ->from(Address::class, 'a')
            ->where('a.nom LIKE :searchString')
            ->setParameter('searchString', '%' . $searchString . '%');

        return $queryBuilder->getQuery()->getResult();
    }
}
