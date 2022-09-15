<?php

namespace App\Models;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\ORM\Mapping\Table;
use Illuminate\Http\Request;

#[Entity]
#[Table(name:"subjects")]
class Subject
{
    #[OneToMany(mappedBy: "subject", targetEntity: Question::class)]
    protected Collection $question;

    #[Id, Column(type:"guid"), GeneratedValue(strategy: 'UUID')]
    protected string $id;

    #[Column(type:"string", unique:true)]
    protected string $name;

    public function __construct(Request $request)
    {
        $this->setName($request->get('name'));
    }

    public function getSubject(): int
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