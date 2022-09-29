<?php

namespace App\Http\Controllers;


use App\Models\Question;
use App\Repositorys\QuestionRepository;
use App\Services\AnswerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Errors\ErrorHandler;

class AnswerController extends Controller
{
    protected QuestionRepository $questionRepository;
    protected AnswerService $answerService;

    public function __construct(AnswerService $answerService, QuestionRepository $questionRepository)
    {
        $this->answerService = $answerService;
        $this->questionRepository = $questionRepository;
    }

    public function store(Request $request): JsonResponse
    {
        try{
            $this->validateAnswerRequest($request->get('question_id'), $request->get('is_correct'));

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

    private function validateAnswerRequest($questionId, $isCorrect)
    {
        /**
         * @var Question $question
         */
        $question = $this->questionRepository->getById($questionId);

        if(!$question){
            throw new \Exception("The question with id $questionId not exists");
        }

        if($isCorrect === true && $question->hasCorrectAnswer()){
            throw new \Exception("The question already have a correct answer. The max amount of correct answers is 1");
        }
    }
}