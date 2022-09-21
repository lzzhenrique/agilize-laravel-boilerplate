<?php

namespace App\Http\Controllers;


use App\Http\Errors\ErrorHandler;
use App\Models\Exam;
use App\Services\ExamAnswersService;
use App\Services\ExamQuestionsService;
use App\Services\ExamService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ExamController
{
    protected ExamService $examService;
    protected ExamQuestionsService $examQuestionsService;
    protected ExamAnswersService $examAnswersService;

    public function __construct(
        ExamService $examService,
        ExamQuestionsService $examQuestionsService,
        ExamAnswersService $examAnswersService
    )
    {
        $this->examService = $examService;
        $this->examQuestionsService = $examQuestionsService;
        $this->examAnswersService = $examAnswersService;
    }

    public function store(Request $request): JsonResponse
    {
        try{
           $exam = $this->createExam(
               $request->get('student_id'),
               $request->get('subject_id'),
               $request->get('question_quantity')
           );

            return response()->json([
                'message' => 'The exam ' .  $exam->getId() . ' are created successfully'
            ]);

        }catch (\Exception $e){
            ErrorHandler::handleException($e);
        }
    }

    private function createExam($studentId, $subjectId, $questionQuantity): Exam
    {
        $exam = $this->examService->create($studentId, $subjectId, $questionQuantity);

        $this->createExamQuestions($exam);
        $this->createExamAnswers($exam);

        return $exam;
    }

    private function createExamQuestions(Exam $exam): void
    {
        $this->examQuestionsService->create($exam);
    }

    private function createExamAnswers($exam)
    {
        $this->examAnswersService->create($exam);
    }
}