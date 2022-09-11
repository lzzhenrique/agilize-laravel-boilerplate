<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/subject', [SubjectController::class, 'index']);
Route::post('/subject/create', [SubjectController::class, 'store']);
Route::delete('/subject/remove', [SubjectController::class, 'remove']);

Route::get('/student', [StudentController::class, 'index']);
Route::post('/student/create', [StudentController::class, 'store']);
Route::delete('/student/remove', [StudentController::class, 'remove']);
