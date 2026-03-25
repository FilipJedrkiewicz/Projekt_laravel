<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    //Instrukcja
    Route::get('/tasks/{task}/instruction', [TaskController::class, 'instruction'])->name('tasks.instruction');
    Route::get('/tasks/{task}/instruction/edit', [TaskController::class, 'editInstruction'])->name('tasks.instruction.edit');
    Route::patch('/tasks/{task}/instruction', [TaskController::class, 'updateInstruction'])->name('tasks.instruction.update');
    // Reset
    Route::delete('/tasks/reset', [TaskController::class, 'reset'])->name('tasks.reset');
    // Widok listy zadań
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Dodawanie
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Edycja (widok)
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    // Aktualizacja (checkbox i formularz)
    Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    // Usuwanie
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');


    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
