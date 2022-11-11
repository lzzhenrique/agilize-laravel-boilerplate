<?php

namespace App\Services;


use App\Models\Answer;
use App\Repositorys\AnswerRepository;
use App\Repositorys\QuestionRepository;

class AnswerService
{
    protected AnswerRepository $answerRepository;
    protected QuestionRepository $questionRepository;

    public function __construct(
        AnswerRepository $answerRepository,
        QuestionRepository $questionRepository
    )
    {
        $this->answerRepository = $answerRepository;
        $this->questionRepository = $questionRepository;
    }

    public function create(
        $answer,
        $questionId,
        $isCorrect
    ) : Answer
    {

        $this->validateAnswerRequest(
            [
                'answer' => $answer,
                'questionId' => $questionId,
                'isCorrect' => $isCorrect
            ]
        );

        return $this->answerRepository->create(
            new Answer(
                $answer,
                $isCorrect,
                $this->questionRepository->getById($questionId)
            )
        );
    }

    private function validateAnswerRequest($request)
    {
        foreach ($request as $key => $value) {
            if (!isset($value)) {
                throw new \Exception("the $key value not can be empty! 1307497968");
            }
        }

        if ($this->questionRepository->getById($request['questionId']) === null) {
            throw new \Exception('The answer not have a question 5976306300');
        }

        if (!is_bool($request['isCorrect'])) {
            throw new \Exception('The isCorrect value not is a boolean 5976306300');
        }
    }
}