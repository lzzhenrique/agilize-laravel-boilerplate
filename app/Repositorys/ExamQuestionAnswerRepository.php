<?php

namespace App\Repositorys;


use App\Models\ExamQuestion;
use App\Models\ExamQuestionAnswer;
use Doctrine\ORM\EntityManager;

class ExamQuestionAnswerRepository
{

    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(ExamQuestionAnswer $examQuestionAnswer)
    {
        $this->entityManager->persist($examQuestionAnswer);
        $this->entityManager->flush();
    }
}