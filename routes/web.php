<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ForgotPasswordController;
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
// Manager Dashboard - Only managers can access
// Manager Routes
Route::middleware(['auth', 'role:manager'])->group(function () {

    // Manager Dashboard
    Route::get('/manager/dashboard', [ManagerController::class, 'dashboard']);

    // Display Add Employee Form
    Route::get('/manager/employees/create', [EmployeeController::class, 'create']);

    // Save Employee Details
    Route::post('/manager/employees', [EmployeeController::class, 'store']);
// Display all employees
Route::get('/manager/employees', [EmployeeController::class, 'index']);
});

// Employee Dashboard - Only employees can access
Route::middleware(['auth', 'role:employee'])->group(function () {

    Route::get('/employee/dashboard', [EmployeeController::class, 'dashboard']);

});
// Display Assign Task Form
Route::get('/manager/tasks/create', [ManagerController::class, 'createTask']);

// Save and Assign Task
Route::post('/manager/tasks', [ManagerController::class, 'storeTask']);
Route::post(
    '/employee/tasks/{id}/status',
    [EmployeeController::class, 'updateTaskStatus']
);
Route::get('/manager/tasks/progress', [ManagerController::class, 'taskProgress']);
// Edit Task
Route::get('/manager/tasks/{id}/edit', [ManagerController::class, 'editTask']);

// Update Task
Route::put('/manager/tasks/{id}', [ManagerController::class, 'updateTask']);

// Delete Task
Route::delete('/manager/tasks/{id}', [ManagerController::class, 'deleteTask']);
Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])
    ->name('manager.employees.edit');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])
    ->name('manager.employees.update');

Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])
    ->name('manager.employees.destroy');
    Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])
    ->name('manager.employees.edit');

Route::put('/employees/{id}', [EmployeeController::class, 'update'])
    ->name('manager.employees.update');

Route::delete('/employees/{id}', [EmployeeController::class, 'destroy'])
    ->name('manager.employees.destroy');
    Route::get('/profile', [ProfileController::class, 'edit'])
    ->name('profile.edit');

Route::put('/profile', [ProfileController::class, 'update'])
    ->name('profile.update');
    // Forgot Password
Route::get('/forgot-password',
    [ForgotPasswordController::class, 'showLinkRequestForm']
)->name('password.request');

Route::post('/forgot-password',
    [ForgotPasswordController::class, 'sendResetLinkEmail']
)->name('password.email');

// Reset Password
Route::get('/reset-password/{token}',
    [ForgotPasswordController::class, 'showResetForm']
)->name('password.reset');

Route::post('/reset-password',
    [ForgotPasswordController::class, 'reset']
)->name('password.update');