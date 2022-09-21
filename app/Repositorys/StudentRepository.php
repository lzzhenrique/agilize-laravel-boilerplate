<?php

namespace App\Repositorys;


use App\Models\Student;
use Doctrine\ORM\EntityManager;

class StudentRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Student $student): Student
    {
        $this->entityManager->persist($student);
        $this->entityManager->flush();

        return $student;
    }

    public function getById($id): Student
    {
        return $this->entityManager->find(Student::class, $id);
    }
}