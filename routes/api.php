<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\QuizController;
use App\Http\Controllers\Api\CsoUserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('quiz', [QuizController::class, 'index']);

Route::get('cso-user/{uuid}', [CsoUserController::class, 'show']);
Route::post('cso-user/{uuid}', [CsoUserController::class, 'store']);