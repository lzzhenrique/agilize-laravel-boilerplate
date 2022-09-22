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
#[Table(name:"exam_questions")]
class ExamQuestion
{
    public function __construct(Question $question, Exam $exam)
    {
        $this->question = $question->getQuestion();
        $this->exam = $exam;
    }

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    protected string $question;

    #[ManyToOne(targetEntity: Exam::class, cascade: ["persist"], inversedBy: "exam")]
    protected Exam  $exam;

    public function getId()
    {
        return $this->id;
    }
    public function getQuestionId()
    {
        return $this->question;
    }

}