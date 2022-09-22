<?php

namespace App\Services;


use App\Models\Exam;
use App\Repositorys\ExamRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;

class ExamService
{
    protected SubjectRepository $subjectRepository;
    protected ExamRepository $examRepository;
    protected StudentRepository $studentRepository;
    protected QuestionRepository $questionRepository;

    protected ExamQuestionsService $examQuestionsService;
    protected ExamAnswersService $examAnswersService;

    public function __construct(
        SubjectRepository $subjectRepository,
        ExamRepository $examRepository,
        StudentRepository $studentRepository,
        QuestionRepository $questionRepository,
        ExamQuestionsService $examQuestionsService,
        ExamAnswersService $examAnswersService
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->examRepository = $examRepository;
        $this->studentRepository = $studentRepository;
        $this->questionRepository = $questionRepository;
        $this->examQuestionsService = $examQuestionsService;
        $this->examAnswersService = $examAnswersService;
    }

    public function create($studentId, $subjectId, $questionQuantity)
    {
        $this->validateExamRequest(
            [
                'studentId' => $studentId,
                'subjectId' => $subjectId,
                'questionQuantity' => $questionQuantity
            ]
        );

        $exam = $this->createExam($studentId, $subjectId, $questionQuantity);

        $examQuestions = $this->createExamQuestions($exam);
        $this->createExamAnswers($examQuestions);

        return $exam;
    }

    private function validateExamRequest($request)
    {
        foreach ($request as $key => $value) {
            if (!isset($value)) {
                throw new \Exception("the $key value not can be empty!");
            }
        }

        if($this->questionRepository->countQuestionsBySubject($request['subjectId']) < $request['questionQuantity']){
            throw new \Exception("the quantity of questions is less than the requested quantity");
        }
    }

    private function createExam($studentId, $subjectId, $questionQuantity)
    {
        return $this->examRepository->create(
            new Exam(
                $this->studentRepository->getById($studentId),
                $this->subjectRepository->getById($subjectId),
                $questionQuantity
            )
        );
    }

    private function createExamQuestions(Exam $exam)
    {
        return $this->examQuestionsService->create($exam);
    }

    private function createExamAnswers($examQuestions)
    {
        $this->examAnswersService->create($examQuestions);
    }
}