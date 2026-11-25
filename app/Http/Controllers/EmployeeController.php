<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class EmployeeController extends Controller
{
   public function dashboard()
{
    $tasks = Auth::user()->assignedTasks()->latest()->get();

    return view('employee.dashboard', compact('tasks'));
}

public function create()
{
    return view('manager.employees.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8',
    ]);

    User::create([
        'name' => $validated['name'],
        'email' => $validated['email'],
        'password' => Hash::make($validated['password']),
        'role' => 'employee',
    ]);

    return redirect('/manager/employees')
        ->with('success', 'Employee created successfully!');
}
public function index()
{
    $employees = User::where('role', 'employee')->get();

    return view('manager.employees.index', compact('employees'));
}
public function updateTaskStatus(Request $request, $id)
{
    $validated = $request->validate([
        'status' => 'required|in:Pending,In Progress,Completed',
    ]);

    // Find only a task assigned to the logged-in employee
    $task = Auth::user()->assignedTasks()->findOrFail($id);

    $task->update([
        'status' => $validated['status'],
    ]);

    return redirect('/employee/dashboard')
        ->with('success', 'Task status updated successfully!');
}
}
