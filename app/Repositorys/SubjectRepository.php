<?php

namespace App\Repositorys;

use App\Models\Subject;
use Doctrine\ORM\EntityManager;

class SubjectRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Subject $subject) : Subject
    {
        $this->entityManager->persist($subject);
        $this->entityManager->flush();

        return $subject;
    }

    public function getById(string $id)
    {
        return $this->entityManager->find(
            Subject::class,
            $id
        );
    }
}