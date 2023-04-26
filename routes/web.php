<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ReportController;
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

Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::post('/users/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
    Route::post('/quiz', [QuizController::class, 'create'])->name('quiz.create');
    Route::get('/quiz/{id}/edit', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::post('/quiz/{id}/store', [QuizController::class, 'store'])->name('quiz.store');

    Route::post('/quiz/{id}/question/edit', [QuizController::class, 'editQuestion'])->name('question.edit');
    Route::post('/quiz/{id}/question/store', [QuizController::class, 'storeQuestion'])->name('question.store');

    Route::get('/report', [ReportController::class, 'index'])->name('report');
});

require __DIR__.'/auth.php';

Route::get('/{any}', function () {
    return view('index');
})->where("any",".*");
