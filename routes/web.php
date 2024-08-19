<?php

use App\Http\Controllers\{ProfileController, ToDoListController};
use Illuminate\Support\Facades\Route;



Route::middleware('auth')->group(function () {
    Route::get('/', [ToDoListController::class, 'index'])->name('todo.home');
    Route::post('/store', [ToDoListController::class, 'store'])->name('todo.store');
    Route::get('/show/{id}', [ToDoListController::class, 'show'])->name('todo.show');
    Route::patch('/update/{id}', [ToDoListController::class, 'update'])->name('todo.update');
    Route::get('/edit/{id}', [ToDoListController::class, 'edit'])->name('todo.edit');
    Route::delete('/delete', [ToDoListController::class, 'destroy'])->name('todo.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
