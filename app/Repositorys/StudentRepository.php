<?php

namespace App\Repositorys;


use App\Models\Student;
use App\Repositorys\Interfaces\IStudent;
use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class StudentRepository implements IStudent
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Request $request)
    {
        $student = $this->prepareData($request);

        $this->entityManager->persist($student);
        $this->entityManager->flush();
    }

    public function remove(Student $student)
    {
        try {
            $this->entityManager->remove($student);

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

    private function prepareData(Request $request)
    {
        return new Student($request);
    }

    public function getById(string $id)
    {
        return $this->entityManager->getRepository(
            Student::class)
            ->findOneBy(['id' => $id]);
    }
}