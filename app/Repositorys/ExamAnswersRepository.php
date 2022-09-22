<?php

namespace App\Repositorys;


use App\Models\ExamAnswer;
use Doctrine\ORM\EntityManager;

class ExamAnswersRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(ExamAnswer $examAnswer)
    {
        $this->entityManager->persist($examAnswer);
        $this->entityManager->flush();
    }
}