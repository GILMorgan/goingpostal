<?php

namespace App\Repository;

use App\Entity\Draft;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Translation\Exception\NotFoundResourceException;

/**
 * Repository des brouillons
 */
class DraftRepository
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
        $this->repository = $entityManager->getRepository(Draft::class);
    }

    /**
     * @param string $draftId
     *
     * @return Draft
     *
     * @throws \NotFoundResourceException
     */
    public function find(string $draftId): Draft
    {
        $draft = $this->repository->find($draftId);

        if (!$draft) {
            throw new NotFoundResourceException(
                sprintf("Unable to find draft with id %s", $draftId)
            );
        }

        return $draft;
    }

    /**
     * Retourne tout les brouillons qui n'ont pas encore été postés
     *
     * @return array
     */
    public function findAllNotPosted(): array
    {
        $query = $this->entityManager->createQuery(
            "SELECT d
            FROM App\Entity\Draft d
            WHERE d.isPosted = 0
            ORDER BY d.date ASC"
        );

        return $query->getResult();
    }

    /**
     * Retourne tout les brouillons postés
     *
     * @return array
     */
    public function findAllPosted(): array
    {
        $query = $this->entityManager->createQuery(
            "SELECT d
            FROM App\Entity\Draft d
            WHERE d.isPosted = 1
            ORDER BY d.date ASC"
        );

        return $query->getResult();
    }

    /**
     * @param Draft $draft
     *
     * @return Draft
     */
    public function save(Draft $draft): Draft
    {
        $this->entityManager->persist($draft);
        $this->entityManager->flush();

        return $draft;
    }

    /**
     * @param Draft $draft
     */
    public function delete(Draft $draft)
    {
        $this->entityManager->remove($draft);
        $this->entityManager->flush();
    }
}