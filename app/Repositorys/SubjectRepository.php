<?php

namespace App\Repositorys;

use App\Models\Student;
use App\Models\Subject;
use App\Repositorys\Interfaces\ISubject;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class SubjectRepository implements ISubject
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Subject $subject)
    {
        $this->entityManager->persist($subject);
        $this->entityManager->flush();
    }

    public function remove(Subject $subject)
    {
        try {
            $this->entityManager->remove($subject);

            $this->entityManager->flush();

        }catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function getAll() : array
    {
        return $this->entityManager->getRepository(
            Student::class )
            ->findAll();
    }

    public function getById(string $id)
    {
        return $this->entityManager
            ->getRepository(Student::class)
            ->findOneBy(['id' => $id]);
    }
}