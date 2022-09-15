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
    protected string $answer;

    #[Column(type:"boolean")]
    protected string $is_correct;

    #[ManyToOne(targetEntity: Question::class, inversedBy: "answer")]
    protected Question  $question;


    public function __construct($input)
    {
        $this->setAnswer($input['answer']);
        $this->setIsCorrect($input['is_correct']);
        $this->setQuestionId($input['question_id']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): void
    {
        $this->answer = $answer;
    }

    public function getIsCorrect(): string
    {
        return $this->is_correct;
    }

    public function setIsCorrect(string $is_correct): void
    {
        $this->is_correct = $is_correct;
    }

    public function getQuestionId(): string
    {
        return $this->question_id;
    }

    public function setQuestionId(string $question_id): void
    {
        $this->question_id = $question_id;
    }

}