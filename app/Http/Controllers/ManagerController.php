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
        return view('manager.dashboard');
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
    $tasks = Task::with('assignedEmployee')
        ->latest()
        ->get();

    return view('manager.tasks.progress', compact('tasks'));
}
}
