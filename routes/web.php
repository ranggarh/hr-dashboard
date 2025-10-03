<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagedUserController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Assessment Routes
Route::resource('assessments', AssessmentController::class);

// Question Routes
Route::get('/assessments/{assessment}/questions', [QuestionController::class, 'index'])->name('questions.index');
Route::post('/assessments/{assessment}/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');


Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');

Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

Route::prefix('assessments/{assessment}/managed-users')->group(function () {
    Route::get('/', [ManagedUserController::class, 'index'])->name('managed-users.index');
    Route::get('/create', [ManagedUserController::class, 'create'])->name('managed-users.create');
    Route::post('/', [ManagedUserController::class, 'store'])->name('managed-users.store');
});