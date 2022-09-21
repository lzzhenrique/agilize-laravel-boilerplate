<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam_answer")]
class ExamAnswer
{
    public function __construct(ExamQuestion $question, Answer $correctAnswer)
    {
        $this->question = $question;
        $this->correct_answer = $correctAnswer;
    }

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string")]
    protected string $student_answer;

    #[OneToOne(targetEntity: Exam::class, cascade: ["persist"])]
    protected Answer $correct_answer;

    #[OneToOne(inversedBy: "question", targetEntity: ExamQuestion::class)]
    protected ExamQuestion  $question;
}