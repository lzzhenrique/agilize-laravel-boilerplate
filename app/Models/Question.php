<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"questions")]
class Question
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[ManyToOne(targetEntity: Subject::class, cascade: ["persist"], inversedBy: "question")]
    protected Subject $subject;

    #[Column(type:"string")]
    protected string $question;

    public function __construct(string $question, Subject $subject)
    {
        $this->question = $question;
        $this->subject = $subject;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }
}