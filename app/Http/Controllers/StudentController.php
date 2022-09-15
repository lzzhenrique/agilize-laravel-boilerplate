<?php

namespace App\Http\Controllers;


use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController
{
    protected StudentRepository $student;

    public function __construct(StudentRepository $student)
    {
        $this->student = $student;
    }

    public function store(Request $request): JsonResponse
    {
        $this->student->create($request);

        return response()->json(['message' => 'The student ' . $request->get('name') . ' are created successfully']);
    }

    public function remove(Request $request): JsonResponse
    {
        $studentToDelete = $this->student->getById($request->get('id'));

        $this->student->remove($studentToDelete);

        return response()->json(['message' => 'The student ' . $request->get('name') . ' are deleted successfully']);
    }


    public function index()
    {
        $student = $this->student->getAll();

        return response()->json($student);
    }
}