<?php

namespace App\Models;


use Doctrine\Common\Collections\Collection;
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

    #[Column(type:"string")]
    protected string $question;

    #[ManyToOne(targetEntity: Subject::class, inversedBy: "question")]
    protected Subject $subject;

    public function __construct($input)
    {
        $this->setQuestion($input['question']);
        $this->setSubjectId($input['subject']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): void
    {
        $this->question = $question;
    }

    public function getSubjectId(): string
    {
        return $this->subject_id;
    }

    public function setSubjectId(string $subject_id): void
    {
        $this->subject_id = $subject_id;
    }
}