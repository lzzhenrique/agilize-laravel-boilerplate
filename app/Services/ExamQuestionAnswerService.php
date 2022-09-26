<?php

namespace App\Services;


use App\Models\Answer;
use App\Models\Exam;
use App\Models\ExamQuestionAnswer;
use App\Models\Question;
use App\Repositorys\AnswerRepository;
use App\Repositorys\ExamQuestionAnswerRepository;
use App\Repositorys\QuestionRepository;

class ExamQuestionAnswerService
{
    protected QuestionRepository $questionRepository;
    protected AnswerRepository $answerRepository;
    protected ExamQuestionAnswerRepository $examQuestionAnswerRepository;

    public function __construct(
        QuestionRepository           $questionRepository,
        AnswerRepository             $answerRepository,
        ExamQuestionAnswerRepository $examQuestionAnswerRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->examQuestionAnswerRepository = $examQuestionAnswerRepository;
    }

    public function create(Exam $exam): void
    {
        $questions = $this->pickRandomQuestionsBySubject(
            $exam->getSubject(),
            $exam->getQuestionQuantity()
        );


        foreach ($questions as $question) {
            $answers = $this->answerRepository->getAnswersByQuestion($question->getId());

            $examAnswerQuestion = new ExamQuestionAnswer(
                $exam,
                $question,
                $answers
            );

            $this->examQuestionAnswerRepository->create($examAnswerQuestion);
        }
    }

    private function pickRandomQuestionsBySubject($subject, $questionsQuantity): array
    {
        $allQuestions = $this->questionRepository->getAllQuestionsBySubject($subject);

        shuffle($allQuestions);

        return array_slice($allQuestions, 0, $questionsQuantity);
    }
}