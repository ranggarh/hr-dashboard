<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagedUserController;
use App\Http\Controllers\JobseekerController;

// Auth routes (tanpa middleware) - harus di luar
Route::get('login', [AuthController::class, 'showLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegister'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Semua route yang perlu login
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Assessment Routes
    Route::resource('assessments', AssessmentController::class);
    
    // Question Routes
    Route::get('/assessments/{assessment}/questions', [QuestionController::class, 'index'])->name('questions.index');
    Route::post('/assessments/{assessment}/questions', [QuestionController::class, 'store'])->name('questions.store');
    Route::put('/questions/{question}', [QuestionController::class, 'update'])->name('questions.update');
    Route::delete('/questions/{question}', [QuestionController::class, 'destroy'])->name('questions.destroy');
    
    // Managed Users Routes
    Route::prefix('assessments/{assessment}/managed-users')->group(function () {
        Route::get('/', [ManagedUserController::class, 'index'])->name('managed-users.index');
        Route::get('/create', [ManagedUserController::class, 'create'])->name('managed-users.create');
        Route::post('/', [ManagedUserController::class, 'store'])->name('managed-users.store');
        Route::delete('/{managedUser}', [ManagedUserController::class, 'destroy'])->name('managed-users.destroy');
    });
    
    // Jobseekers Routes
    Route::get('/jobseekers', [JobseekerController::class, 'index'])->name('jobseekers.index');
    Route::get('/jobseekers/{jobseeker}', [JobseekerController::class, 'show'])->name('jobseekers.show');
    Route::delete('/jobseekers/{jobseeker}', [JobseekerController::class, 'destroy'])->name('jobseekers.destroy');
    
    // Logout (harus login dulu untuk logout)
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});