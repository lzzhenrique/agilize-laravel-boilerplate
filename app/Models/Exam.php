<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;
use Gedmo\Timestampable\Traits\TimestampableEntity;

#[Entity]
#[Table(name:"exams")]
class Exam
{
    public function __construct(Student $student, Subject $subject, $questionQuantity)
    {
        $this->student = $student;
        $this->subject = $subject;
        $this->question_quantity = $questionQuantity;
    }

    use TimestampableEntity;

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[ManyToOne(targetEntity: Subject::class, cascade: ["persist"], inversedBy: "subject")]
    protected Subject $subject;

    #[ManyToOne(targetEntity: Student::class, cascade: ["persist"], inversedBy: "student")]
    protected Student  $student;

    #[Column(type:"float", nullable: true)]
    protected int $score;

    #[Column(type:"integer")]
    protected int $question_quantity;

    #[Column(type:"datetime", nullable: true)]
    protected \DateTime $finished_at;

    #[OneToMany(mappedBy: "question", targetEntity: Answer::class, cascade: ["persist"], orphanRemoval: true)]
    protected Collection $questions;

    public function getId(): string
    {
        return $this->id;
    }

    public function getFinishedAt(): string
    {
        return $this->finished_at;
    }

    public function getScore(): string
    {
        return $this->score;
    }

    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function getStudent(): Student
    {
        return $this->student;
    }

    public function getQuestionQuantity()
    {
        return $this->question_quantity;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }
}