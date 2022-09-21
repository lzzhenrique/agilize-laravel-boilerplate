<?php

namespace App\Repositorys;


use App\Models\Exam;
use App\Models\ExamQuestion;
use Doctrine\ORM\EntityManager;

class ExamQuestionsRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(ExamQuestion $examQuestion)
    {
        $this->entityManager->persist($examQuestion);
    }

    public function findQuestionsByExam(Exam $exam)
    {
        $queryBuilder  = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('examQuestion')
            ->from(ExamQuestion::class, 'examQuestion')
            ->where('examQuestion.exam = :examId')
            ->setParameter('examId', $exam->getId())
            ->getQuery()
            ->getResult();
    }
}