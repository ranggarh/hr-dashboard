<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssessmentController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Assessment Routes
Route::get('/assessments', [AssessmentController::class, 'index'])->name('assessments.index');
Route::get('/assessments/create', [AssessmentController::class, 'create'])->name('assessments.create');
Route::post('/assessments', [AssessmentController::class, 'store'])->name('assessments.store');