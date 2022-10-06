<?php

namespace App\Models;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"questions")]
class Question
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[ManyToOne(targetEntity: Subject::class, cascade: ["persist"], inversedBy: "question")]
    protected Subject $subject;

    #[OneToMany(mappedBy: "question", targetEntity: Answer::class, cascade: ["persist"], orphanRemoval: true)]
    protected Collection $answers;

    #[Column(type:"string")]
    protected string $question;

    public function __construct(string $question, Subject $subject)
    {
        $this->question = $question;
        $this->subject = $subject;
        $this->answers = new ArrayCollection();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function getSubject(): Subject
    {
        return $this->subject;
    }

    public function getAnswers()
    {
        return $this->answers;
    }

    public function hasCorrectAnswer()
    {
        foreach ($this->answers as $answer) {
            if ($answer->isCorrect()) {
                return true;
            }
        }
    }
}