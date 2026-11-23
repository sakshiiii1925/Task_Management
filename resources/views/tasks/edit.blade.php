
@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-7">

        <div class="task-card">

            <div class="mb-4">
                <h2 class="page-title">Edit Task</h2>
                <p class="text-muted">
                    Update your task information below.
                </p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('tasks.update', $task->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Task Title -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Task Title
                    </label>

                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title', $task->title) }}"
                        placeholder="Enter task title"
                        required
                    >
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Description
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter task description"
                    >{{ old('description', $task->description) }}</textarea>
                </div>

                <!-- Status -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Task Status
                    </label>

                    <select name="status" class="form-select" required>

                        <option value="Pending"
                            {{ old('status', $task->status) == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="In Progress"
                            {{ old('status', $task->status) == 'In Progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Completed"
                            {{ old('status', $task->status) == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                    </select>
                </div>

                <!-- Due Date -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Due Date
                    </label>

                    <input
                        type="date"
                        name="due_date"
                        class="form-control"
                        value="{{ old('due_date', $task->due_date) }}"
                    >
                </div>

                <!-- Buttons -->
                <div class="d-flex gap-2">

                    <button type="submit" class="btn btn-orange px-4">
                        Update Task
                    </button>

                    <a href="{{ url('/tasks') }}"
                       class="btn btn-outline-secondary px-4">
                        Cancel
                    </a>

                </div>

            </form>

        </div>

    </div>
</div>

@endsection
