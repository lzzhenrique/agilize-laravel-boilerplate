<?php

namespace App\Repositorys;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Subject;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class QuestionRepository
{
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Question $question): Question
    {
        $this->entityManager->persist($question);
        $this->entityManager->flush();

        return $question;
    }

    public function getById(string $id)
    {
        return $this->entityManager->find(
            Question::class,
            $id
        );
    }

    public function getAllQuestionsBySubject(string $subjectId)
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        return $queryBuilder->select('question')
            ->from(Question::class, 'question')
            ->where('question.subject = :subject')
            ->setParameter('subject', $subjectId)
            ->getQuery()
            ->getResult();
    }

    public function countQuestionsBySubject(string $subjectId)
    {
        return $this->entityManager->getRepository(Question::class)->count(['subject' => $subjectId]);
    }
}

