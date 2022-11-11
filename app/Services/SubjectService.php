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

    private function validateSubjectRequest($subject)
    {
        if (empty($subject)) {
            throw new \Exception('The subject is empty 6520941995');
        }

        if (strlen($subject) < 3) {
            throw new \Exception('The subject name is too short 2691264833');
        }
    }
}