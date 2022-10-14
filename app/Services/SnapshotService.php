<?php

namespace App\Services;


use App\Models\Exam;
use App\Models\Question;
use App\Models\Snapshot;
use App\Repositorys\AnswerRepository;
use App\Repositorys\SnapshotRepository;
use App\Repositorys\QuestionRepository;

class SnapshotService
{
    protected QuestionRepository $questionRepository;
    protected AnswerRepository $answerRepository;
    protected SnapshotRepository $snapshotRepository;

    public function __construct(
        QuestionRepository $questionRepository,
        AnswerRepository   $answerRepository,
        SnapshotRepository $snapshotRepository)
    {
        $this->questionRepository = $questionRepository;
        $this->answerRepository = $answerRepository;
        $this->snapshotRepository = $snapshotRepository;
    }

    public function create(Exam $exam): array
    {
        $questions = $this->pickRandomQuestionsBySubject(
            $exam->getSubject(),
            $exam->getQuestionQuantity()
        );

        $questionsAndAnswers = [];

        /**
         * @var Question $question
         */
        foreach ($questions as $question) {
            foreach ($question->getAnswers() as $answer) {
                $snapshot = new Snapshot($exam, $question, $answer);

                $this->snapshotRepository->create($snapshot);
            }

            $questionsAndAnswers[$question->getQuestion()] = array_map(function ($answer) {
                return $answer->getAnswer();
            }, $question->getAnswers()->toArray());
        }

        return $questionsAndAnswers;
    }

    public function pickRandomQuestionsBySubject($subject, $questionsQuantity): array
    {
        $allQuestions = $this->questionRepository->getAllQuestionsBySubject($subject);

        shuffle($allQuestions);
        return array_slice($allQuestions, 0, $questionsQuantity);
    }
}