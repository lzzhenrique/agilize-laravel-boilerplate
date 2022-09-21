<?php

namespace App\Models;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;
use http\Env\Request;

#[Entity]
#[Table(name:"students")]
class Student
{
    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string")]
    protected string $name;

    public function __construct($name)
    {
        $this->setName($name);
    }

    protected function getStudent(): int
    {
        return $this->id;
    }

    public  function getStudentName(): string
    {
        return $this->name;
    }

    protected  function setName(string $name): void
    {
        $this->name = $name;
    }
}