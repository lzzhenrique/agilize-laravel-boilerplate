<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

#[Entity]
#[Table(name:"subjects")]
class Subject
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string", unique:true)]
    protected string $name;

    public function __construct($input)
    {
        $this->setName($input['name']);
    }

    protected function getSubject(): int
    {
        return $this->id;
    }

    protected  function getSubjectName(): string
    {
        return $this->name;
    }

    protected  function setName(string $name): void
    {
        $this->name = $name;
    }
}