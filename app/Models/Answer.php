<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"answers")]
class Answer
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string")]
    public string $answer;

    #[Column(type:"boolean")]
    protected bool $is_correct;

    #[ManyToOne(targetEntity: Question::class, cascade: ["persist"], inversedBy: "answers")]
    protected Question  $question;

    public function __construct($answer, bool $is_correct, Question $question)
    {
        $this->answer = $answer;
        $this->is_correct = $is_correct;
        $this->question = $question;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function isCorrect(): bool
    {
        return (bool)$this->is_correct;
    }

    public function getQuestionId(): string
    {
        return $this->question_id;
    }
}