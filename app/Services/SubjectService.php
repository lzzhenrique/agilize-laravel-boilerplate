<?php

namespace App\Services;


use App\Repositorys\SubjectRepository;
use App\Models\Subject;


class SubjectService
{
    protected SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $subjectRepository)
    {
        $this->subjectRepository = $subjectRepository;

    }

    public function create($subjectName): Subject
    {
        $this->validateSubjectRequest($subjectName);

        return $this->subjectRepository->create(new Subject($subjectName));
    }

    private function validateSubjectRequest($subjectName)
    {
        if (empty($subjectName)) {
            throw new \Exception('The subject is empty');
        }

        if (strlen($subjectName) < 3) {
            throw new \Exception('The subject name is too short');
        }
    }
}