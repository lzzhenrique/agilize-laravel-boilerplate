<?php

namespace App\Repositorys\Interfaces;


use App\Models\Subject;
use Illuminate\Http\Request;

interface ISubject
{
    public function create(Request $request);
    public function remove(Subject $subject);
    public function getAll() : array;
}