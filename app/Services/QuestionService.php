<?php

namespace App\Services;

use App\Models\Question;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SubjectRepository;

class QuestionService
{
    protected SubjectRepository $subjectRepository;
    protected QuestionRepository $questionRepository;

    public function __construct(
        SubjectRepository $subjectRepository,
        QuestionRepository $questionRepository
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->questionRepository = $questionRepository;
    }

    public function create($question, $subjectId): Question
    {
        $this->validateQuestionRequest($question, $subjectId);

        return $this->questionRepository->create(
            new Question($question, $this->subjectRepository->getById($subjectId))
        );
    }

    private function validateQuestionRequest($question, $subjectId)
    {
        if (empty($question)) {
            throw new \Exception('The question is empty');
        }

        if ($this->subjectRepository->getById($subjectId) === null) {
            throw new \Exception('This question not have a subject');
        }
    }
}
