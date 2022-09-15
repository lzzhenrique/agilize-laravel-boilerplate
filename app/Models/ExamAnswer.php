<?php

namespace App\Models;


use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToOne;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"exam_answer")]
class ExamAnswer
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string")]
    protected string $answer;

    #[Column(type:"boolean")]
    protected string $is_correct;

    #[Column(type:"boolean")]
    protected string $is_marked;

    #[ManyToOne(targetEntity: ExamQuestion::class, inversedBy: "question")]
    protected ExamQuestion  $question;
}