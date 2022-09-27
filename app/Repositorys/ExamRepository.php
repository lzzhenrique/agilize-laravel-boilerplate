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
}