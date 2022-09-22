<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam_answer")]
class ExamAnswer
{
    public function __construct(Question $question, Answer $correctAnswer)
    {
        $this->question = $question;
        $this->correct_answer = $correctAnswer;
    }

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string", nullable: true)]
    protected string $student_answer;

    #[OneToOne(targetEntity: Answer::class, cascade: ["persist"])]
    protected Answer $correct_answer;

    #[Column(type:"string", nullable: true)]
    protected string  $question;
}