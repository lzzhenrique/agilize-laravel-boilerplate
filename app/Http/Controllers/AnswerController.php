<?php

namespace App\Http\Controllers;


use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Errors\ErrorHandler;

class AnswerController extends Controller
{
    protected AnswerService $answerService;

    public function __construct(AnswerService $answerService)
    {
        $this->answerService = $answerService;
    }

    public function store(Request $request): JsonResponse
    {
        try{
            $answer = $this->answerService
                ->create(
                    $request->get('answer'),
                    $request->get('question_id'),
                    $request->get('is_correct')
                );

            return response()->json([
                'message' => 'The answer ' .  $answer->getAnswer() . ' are created successfully'
            ]);

        }catch (\Exception $e){
            ErrorHandler::handleException($e);
        }
    }
}