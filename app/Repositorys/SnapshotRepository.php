<?php

namespace App\Repositorys;


use App\Models\Exam;
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

        return $queryBuilder->select('snapshot')
            ->from(Snapshot::class, 'snapshot')
            ->where('snapshot.exam = :examSnapshot')
            ->setParameter('examSnapshot', $examId)
            ->getQuery()
            ->getResult();
    }

    public function getCorrectAnswersByExam(Exam $exam)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('snapshot.question, snapshot.answer')
            ->from(Snapshot::class, 'snapshot')
            ->where('snapshot.exam = :exam')
            ->andWhere('snapshot.isCorrect = true')
            ->indexBy('snapshot', 'snapshot.question')
            ->setParameter('exam', $exam)
            ->getQuery()
            ->getResult();
    }
}