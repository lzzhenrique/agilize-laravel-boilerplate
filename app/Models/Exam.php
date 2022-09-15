<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam")]
class Exam
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"datetime")]
    protected string $finished_at;

    #[Column(type:"integer")]
    protected string $score;

    #[ManyToOne(targetEntity: Subject::class, inversedBy: "subject")]
    protected Subject $subject;

    #[ManyToOne(targetEntity: Student::class, inversedBy: "student")]
    protected Student  $student;
}