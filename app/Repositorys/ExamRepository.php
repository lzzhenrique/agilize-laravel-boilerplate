<?php

namespace App\Repositorys;


use App\Models\Exam;
use Doctrine\ORM\EntityManager;

class ExamRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Exam $exam): Exam
    {
        $this->entityManager->persist($exam);

        return $exam;
    }

    public function getById(string $id): Exam
    {
        return $this->entityManager->find(
            Exam::class,
            $id
        );
    }

    public function finishExam(Exam $exam, $score, $finishedAt)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return  $queryBuilder->update(Exam::class, 'exam')
            ->set('exam.score', ':score')
            ->set('exam.finished_at', ':finishedAt')
            ->where('exam = :exam')
            ->setParameters([
                'exam' => $exam,
                'score' => $score,
                'finishedAt' => $finishedAt,
            ])
            ->getQuery()
            ->execute();
    }
}