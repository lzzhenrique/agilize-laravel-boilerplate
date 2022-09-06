<?php

namespace App\Entities;

    /**
     * @Doctrine\ORM\Mapping\Entity
     * @Doctrine\ORM\Mapping\Table(name="subjects")
     * @Doctrine\ORM\Mapping\HasLifecycleCallbacks()
     */

class Subjects
{
    /**
     * @var integer $id
     * @Doctrine\ORM\Mapping\Column(name="id", type="integer", unique=true, nullable=false)
     * @Doctrine\ORM\Mapping\Id
     * @Doctrine\ORM\Mapping\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $name
     * @Doctrine\ORM\Mapping\Column(name="name", type="string", unique=true, nullable=false)
     */
    private $name;


    public function __construct($input)
    {
        $this->setName($input['name']);
    }

    protected function getSubject()
    {
        return $this->id;
    }

    protected function getName()
    {
        return $this->name;
    }
}