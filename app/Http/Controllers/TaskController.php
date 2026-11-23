<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Display all tasks
    public function index()
    {
        $tasks = Task::all();

        return view('tasks.index', compact('tasks'));
    }

    // Display the task form
    public function create()
    {
        return view('tasks.create');
    }

    // Save a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'nullable',
            'status' => 'required',
            'due_date' => 'nullable|date',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date,
        ]);

        return redirect('/tasks')->with('success', 'Task added successfully!');
    }
    public function edit($id)
{
    $task = Task::findOrFail($id);

    return view('tasks.edit', compact('task'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string|max:100',
        'description' => 'nullable|string|max:1000',
        'status' => 'required|in:Pending,In Progress,Completed',
        'due_date' => 'nullable|date|after_or_equal:today',
    ]);

    $task = Task::findOrFail($id);

    $task->update($validated);

    return redirect('/tasks')
        ->with('success', 'Task updated successfully!');
}
public function destroy($id)
{
    $task = Task::findOrFail($id);

    $task->delete();

    return redirect('/tasks')->with('success', 'Task deleted successfully!');
}
}