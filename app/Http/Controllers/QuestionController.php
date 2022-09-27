<?php

namespace App\Http\Controllers;


use App\Http\Errors\ErrorHandler;
use App\Models\Question;
use App\Repositorys\QuestionRepository;
use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $question = $this->questionService
                ->create(
                    $request->get('question'),
                    $request->get('subject')
                );

            return response()->json(
                ['message' => 'The question ' .  $question->getQuestion() . ' are created successfully'
           ]);
        } catch (\Exception $e) {
            ErrorHandler::handleException($e);
        }
    }
}