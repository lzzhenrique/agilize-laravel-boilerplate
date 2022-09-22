<?php

namespace App\Repositorys;


use App\Models\Answer;
use App\Models\Question;
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

    public function getCorrectAnswer(Question $question) {
        $queryBuilder  = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('answer')
            ->from(Answer::class, 'answer')
            ->where('answer.is_correct = true')
            ->andWhere('answer.question = :questionId')
            ->setParameter('questionId', $question->getQuestion())
            ->getQuery()
            ->getOneOrNullResult();
    }
}