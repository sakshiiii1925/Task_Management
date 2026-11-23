<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>

   
@extends('layouts.app')

@section('title', 'My Tasks')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title">My Tasks</h2>
        <p class="text-muted">Manage and track all your tasks.</p>
    </div>

    <a href="{{ url('/tasks/create') }}" class="btn btn-orange">
        + Add New Task
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@forelse($tasks as $task)

    <div class="task-card">

        <div class="d-flex justify-content-between align-items-start">

            <div>
                <h5 class="fw-bold">{{ $task->title }}</h5>

                <p class="text-muted mb-2">
                    {{ $task->description ?? 'No description available' }}
                </p>
            </div>

            <div>
                @if($task->status == 'Completed')
                    <span class="badge bg-success">Completed</span>
                @elseif($task->status == 'In Progress')
                    <span class="badge bg-primary">In Progress</span>
                @else
                    <span class="badge bg-warning text-dark">Pending</span>
                @endif
            </div>

        </div>

        <hr>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

            <div>
                <strong>Due Date:</strong>

                {{ $task->due_date
                    ? \Carbon\Carbon::parse($task->due_date)->format('d M Y')
                    : 'Not specified' }}

                @if($task->status == 'Completed')
                    <span class="badge bg-success ms-2">Completed</span>
                @elseif($task->due_date && \Carbon\Carbon::parse($task->due_date)->isPast() && !\Carbon\Carbon::parse($task->due_date)->isToday())
                    <span class="badge bg-danger ms-2">Overdue</span>
                @elseif($task->due_date && \Carbon\Carbon::parse($task->due_date)->isToday())
                    <span class="badge bg-warning text-dark ms-2">Due Today</span>
                @elseif($task->due_date)
                    <span class="badge bg-info text-dark ms-2">Upcoming</span>
                @endif
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('tasks.edit', $task->id) }}"
                   class="btn btn-sm btn-outline-primary">
                    Edit
                </a>

                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                        class="btn btn-sm btn-outline-danger"
                        onclick="return confirm('Are you sure you want to delete this task?')">
                        Delete
                    </button>
                </form>

            </div>

        </div>

    </div>

@empty

    <div class="task-card text-center">
        <h5>No tasks found!</h5>
        <p class="text-muted">Start by adding your first task.</p>

        <a href="{{ url('/tasks/create') }}" class="btn btn-orange">
            Add New Task
        </a>
    </div>

@endforelse

@endsection




</body>
</html>
