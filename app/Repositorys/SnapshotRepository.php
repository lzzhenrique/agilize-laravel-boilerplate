<?php

namespace App\Repositorys;


use App\Models\Snapshot;
use Doctrine\ORM\EntityManager;

class SnapshotRepository
{

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Snapshot $snapshot)
    {
        $this->entityManager->persist($snapshot);
        $this->entityManager->flush();
    }

    public function getByExamId($examId)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return  $queryBuilder->select('snapshot')
            ->from(Snapshot::class, 'snapshot')
            ->where('snapshot.exam = :examSnapshot')
            ->setParameter('examSnapshot', $examId)
            ->getQuery()
            ->getResult();
    }
}