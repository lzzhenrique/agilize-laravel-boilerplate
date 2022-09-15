<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Repositorys\SubjectRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SubjectController extends Controller
{
    protected SubjectRepository $subjects;

    public function __construct(SubjectRepository $subjects)
    {
        $this->subjects = $subjects;
    }

    public function store(Request $request): JsonResponse
    {
        $this->subjects->create(new Subject($request));

        return response()->json(['message' => 'Subject ' . $request->get('name') . ' created successfully']);
    }

    public function remove(Request $request): JsonResponse
    {
        $subjectToDelete = $this->subjects->getById($request->get('id'));

        $this->subjects->remove($subjectToDelete);

        return response()->json(['message' => 'Subject ' . $request->get('name') . ' deleted successfully']);
    }


    public function index()
    {
        $subjects = $this->subjects->getAll();

        return response()->json($subjects);
    }
}