<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ManagerController extends Controller
{
    public function dashboard()
{
    $totalEmployees = User::where('role', 'employee')->count();

    $totalTasks = Task::count();

    $completedTasks = Task::where('status', 'Completed')->count();

    $pendingTasks = Task::where('status', 'Pending')->count();

    $inProgressTasks = Task::where('status', 'In Progress')->count();

    $completionPercentage = $totalTasks > 0
        ? round(($completedTasks / $totalTasks) * 100, 2)
        : 0;

    // Employee-wise task performance
    $employeePerformance = User::where('role', 'employee')
        ->withCount([
            'assignedTasks',
            'assignedTasks as completed_tasks_count' => function ($query) {
                $query->where('status', 'Completed');
            },
        ])
        ->orderBy('name')
        ->get();

    return view('manager.dashboard', compact(
        'totalEmployees',
        'totalTasks',
        'completedTasks',
        'pendingTasks',
        'inProgressTasks',
        'completionPercentage',
        'employeePerformance'
    ));
}
    public function createTask()
{
    $employees = User::where('role', 'employee')->get();

    return view('manager.tasks.create', compact('employees'));
}
public function storeTask(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'status' => 'required|in:Pending,In Progress,Completed',
        'due_date' => 'nullable|date',
        'assigned_to' => 'required|exists:users,id',
    ]);

    $employee = User::where('role', 'employee')
        ->findOrFail($validated['assigned_to']);

    Task::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'status' => $validated['status'],
        'due_date' => $validated['due_date'],
        'assigned_to' => $employee->id,
        'created_by' => Auth::id(),
    ]);

    return redirect('/manager/dashboard')
        ->with('success', 'Task assigned successfully!');
}
public function taskProgress()
{
    $tasks = Task::with('assignedEmployee')->get();

    // Total tasks
    $totalTasks = Task::count();

    // Completed tasks
    $completedTasks = Task::where('status', 'Completed')->count();

    // In Progress tasks
    $inProgressTasks = Task::where('status', 'In Progress')->count();

    // Overdue tasks (past due date and not completed)
    $dueTasks = Task::whereDate('due_date', '<', today())
        ->where('status', '!=', 'Completed')
        ->count();

    return view('manager.tasks.progress', compact(
        'tasks',
        'totalTasks',
        'completedTasks',
        'inProgressTasks',
        'dueTasks'
    ));
}
// Show Edit Task Form
public function editTask($id)
{
    $task = Task::findOrFail($id);

    $employees = User::where('role', 'employee')->get();

    return view('manager.tasks.edit', compact('task', 'employees'));
}


// Update Task
public function updateTask(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
        'status' => 'required|in:Pending,In Progress,Completed',
        'due_date' => 'nullable|date',
        'assigned_to' => 'required|exists:users,id',
    ]);

    $employee = User::where('role', 'employee')
        ->findOrFail($validated['assigned_to']);

    $task = Task::findOrFail($id);

    $task->update([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'status' => $validated['status'],
        'due_date' => $validated['due_date'],
        'assigned_to' => $employee->id,
    ]);

    return redirect('/manager/tasks/progress')
        ->with('success', 'Task updated successfully!');
}


// Delete Task
public function deleteTask($id)
{
    $task = Task::findOrFail($id);

    $task->delete();

    return redirect('/manager/tasks/progress')
        ->with('success', 'Task deleted successfully!');
}
}
