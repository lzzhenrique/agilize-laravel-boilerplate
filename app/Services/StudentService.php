<?php

namespace App\Services;


use App\Models\Student;
use App\Repositorys\StudentRepository;
use http\Env\Request;

class StudentService
{
    protected StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function create($name) : Student
    {
        $this->validateStudentName($name);

        return $this->studentRepository->create(new Student($name));
    }

    private function validateStudentName($name)
    {
        if(!$name || strlen($name) < 3) {
            throw new \Exception('The student has to be a valid name');
        }
    }
}