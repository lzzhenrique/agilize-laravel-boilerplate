<?php

namespace App\Services;


use App\Models\Exam;
use App\Models\ExamAnswer;
use App\Repositorys\AnswerRepository;
use App\Repositorys\ExamAnswersRepository;
use App\Repositorys\ExamQuestionsRepository;

class ExamAnswersService
{
    protected ExamAnswersRepository $examAnswersRepository;
    protected AnswerRepository $answerRepository;
    protected ExamQuestionsRepository $examQuestionsRepository;

    public function __construct(
        ExamAnswersRepository $examAnswersRepository,
        ExamQuestionsRepository $examQuestionsRepository,
        AnswerRepository $answerRepository
    )
    {
        $this->examAnswersRepository = $examAnswersRepository;
        $this->answerRepository = $answerRepository;
        $this->examQuestionsRepository = $examQuestionsRepository;
    }

    public function create(Exam $exam)
    {
        $examQuestions = $this->examQuestionsRepository->findQuestionsByExam($exam);


        foreach ($examQuestions as $examQuestion) {
            $correctAnswer = $this->answerRepository->getCorrectAnswer($examQuestion);

            $this->examAnswersRepository->create(
                new ExamAnswer($examQuestion, $correctAnswer)
            );
        }
    }
}