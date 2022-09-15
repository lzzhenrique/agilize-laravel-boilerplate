<?php

namespace App\Repositorys\Interfaces;


use App\Models\Student;
use Illuminate\Http\Request;

interface ISubject
{
    public function create(Request $request);
    public function remove(Student $subject);
    public function getAll() : array;
}