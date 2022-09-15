<?php

namespace App\Repositorys\Interfaces;


use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

interface ISubject
{
    public function create(Subject $subject);
    public function remove(Subject $subject);
    public function getAll() : array;
}