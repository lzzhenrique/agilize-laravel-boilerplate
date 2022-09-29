<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/subject/create', [SubjectController::class, 'store']);

Route::post('/student/create', [StudentController::class, 'store']);

Route::post('/question/create', [QuestionController::class, 'store']);

Route::post('/answer/create', [AnswerController::class, 'store']);

Route::post('/exam/create', [ExamController::class, 'store']);

Route::put('/exam/update/{exam}', [ExamController::class, 'update']);
