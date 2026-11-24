<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
Route::get('/tasks', [TaskController::class, 'index']);
Route::get('/', function () {
    return view('welcome');
});
Route::get('/tasks/create', [TaskController::class, 'create']);
Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');
    Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])
    ->name('tasks.edit');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])
    ->name('tasks.update');
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
    ->name('tasks.destroy');
    Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);