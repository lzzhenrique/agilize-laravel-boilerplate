<?php

namespace App\Services;


use App\Models\Exam;
use App\Models\ExamQuestion;
use App\Repositorys\ExamQuestionsRepository;
use App\Repositorys\QuestionRepository;

class ExamQuestionsService
{
    protected QuestionRepository $questionRepository;
    protected ExamQuestionsRepository $examQuestionsRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        ExamQuestionsRepository $examQuestionsRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->examQuestionsRepository = $examQuestionsRepository;
    }

    public function create(Exam $exam)
    {
        $questions = $this->pickExamQuestions($exam);
        $examQuestions = [];

        foreach ($questions as $examQuestion) {
            $examQuestion = new ExamQuestion($examQuestion, $exam);

            $this->examQuestionsRepository->create($examQuestion);
            $examQuestions[] = $examQuestion;
        }

        return $examQuestions;
    }

    private function pickExamQuestions(Exam $exam)
    {
        $allQuestions = $this->questionRepository->getAllQuestionsBySubject($exam->getSubject());

        shuffle($allQuestions);

        return array_slice(
            $allQuestions,
            0,
            $exam->getQuestionQuantity()
        );
    }
}