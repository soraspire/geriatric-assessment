<?php

use App\Http\Controllers\AssessmentController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('assessments.create');
});

// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::prefix('assessments')->name('assessments.')->group(function () {
    Route::get('/create', [AssessmentController::class, 'create'])->name('create');
    Route::post('/', [AssessmentController::class, 'store'])->name('store');
    Route::get('/{uuid}', [AssessmentController::class, 'show'])->name('show');
    
    // Management routes protected by auth
    Route::middleware(['auth'])->group(function () {
        Route::get('/', [AssessmentController::class, 'index'])->name('index');
    });
});
