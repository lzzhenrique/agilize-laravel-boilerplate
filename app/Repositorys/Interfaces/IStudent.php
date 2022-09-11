<?php

namespace App\Repositorys\Interfaces;


use App\Models\Student;
use Illuminate\Http\Request;

interface IStudent
{
    public function create(Request $request);
    public function remove(Student $student);
    public function getAll() : array;
}