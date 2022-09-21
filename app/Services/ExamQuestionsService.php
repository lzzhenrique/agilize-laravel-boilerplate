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
        $examQuestions = $this->pickExamQuestions($exam);

        foreach ($examQuestions as $examQuestion) {
            $this->examQuestionsRepository->create(new ExamQuestion($examQuestion, $exam));
        }
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