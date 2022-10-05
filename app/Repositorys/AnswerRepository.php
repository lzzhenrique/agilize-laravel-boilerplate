<?php

namespace App\Repositorys;


use App\Models\Answer;
use Doctrine\ORM\EntityManager;

class AnswerRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Answer $answer) : Answer
    {
        $this->entityManager->persist($answer);
        $this->entityManager->flush();

        return $answer;
    }

    public function getAnswersByQuestion($questionId) {
        $queryBuilder  = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('answer')
            ->from(Answer::class, 'answer')
            ->where('answer.question = :questionId')
            ->setParameter('questionId', $questionId)
            ->getQuery()
            ->getResult();
    }
}