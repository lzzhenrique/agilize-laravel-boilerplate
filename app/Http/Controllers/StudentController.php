<?php

namespace App\Http\Controllers;


use App\Http\Errors\ErrorHandler;
use App\Repositorys\QuestionRepository;
use App\Repositorys\StudentRepository;
use App\Services\StudentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected StudentService $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $student = $this->studentService
                ->create($request->get('name')
           );

            return response()->json([
                'message' => 'The student ' . $student->getStudentName() . ' are created successfully'
            ]);
        } catch (\Exception $e) {
           ErrorHandler::handleException($e);
        }
    }
}