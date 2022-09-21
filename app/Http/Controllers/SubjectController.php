<?php

namespace App\Http\Controllers;

use App\Http\Errors\ErrorHandler;
use App\Models\Subject;
use App\Repositorys\SubjectRepository;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
    protected SubjectService $subjectService;

    public function __construct(SubjectService $subjectService)
    {
        $this->subjectService = $subjectService;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $subject = $this->subjectService
                ->create(
                    $request->get('subject')
                );

            return response()->json([
                'message' => 'The subject ' .  $subject->getSubject() . ' are created successfully'
            ]);
        } catch (\Exception $e) {
            ErrorHandler::handleException($e);
        }
    }
}