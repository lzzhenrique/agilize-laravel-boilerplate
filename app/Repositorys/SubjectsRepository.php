<?php

namespace App\Repositorys;


use Doctrine\ORM\EntityManager;
use Illuminate\Http\Request;

class SubjectsRepository
{
    /**
     * @var EntityManager
     */
    private EntityManager $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create(Request $request)
    {
        $subject = $this->prepareData($request);

        $this->entityManager->persist($subject);
        $this->entityManager->flush();
    }


}