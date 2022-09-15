<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam_questions")]
class ExamQuestion
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string ")]
    protected string $question;

    #[ManyToOne(targetEntity: Exam::class, inversedBy: "exam")]
    protected Exam  $exam;
}