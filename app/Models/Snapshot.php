<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam_question_answer")]
class Snapshot
{
    public function __construct(
        Exam $exam,
        Question $question,
        Answer $answer
    )
    {
        $this->exam = $exam;
        $this->question = $question->getQuestion();
        $this->answer = $answer->getAnswer();
        $this->answerIsCorrect = $answer->isCorrect();
    }

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[ManyToOne(targetEntity: Exam::class, cascade: ["persist"], inversedBy: "exam")]
    private Exam $exam;

    #[Column(type:"string")]
    private string $question;

    #[Column(type:"string")]
    private string $answer;

    #[Column(type:"boolean")]
    private bool $answerIsCorrect;

    #[Column(type:"string", nullable: true)]
    protected string $student_answer;

    public function getQuestion()
    {
        return $this->question;
    }
}