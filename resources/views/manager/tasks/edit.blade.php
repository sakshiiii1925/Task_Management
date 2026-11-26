
@extends('layouts.app')

@section('title', 'Edit Task')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="task-card">

                <h2 class="page-title mb-4">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Task
                </h2>

                <form action="{{ url('/manager/tasks/' . $task->id) }}"
                      method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label">Task Title</label>

                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title', $task->title) }}"
                               required>

                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>

                        <textarea name="description"
                                  class="form-control"
                                  rows="4">{{ old('description', $task->description) }}</textarea>

                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Assign Employee</label>

                        <select name="assigned_to"
                                class="form-select"
                                required>

                            <option value="">Select Employee</option>

                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}"
                                    {{ old('assigned_to', $task->assigned_to) == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('assigned_to')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Task Status</label>

                        <select name="status" class="form-select" required>

                            @foreach(['Pending', 'In Progress', 'Completed'] as $status)
                                <option value="{{ $status }}"
                                    {{ old('status', $task->status) == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach

                        </select>

                        @error('status')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Due Date</label>

                        <input type="date"
                               name="due_date"
                               class="form-control"
                               value="{{ old('due_date', $task->due_date ? \Illuminate\Support\Carbon::parse($task->due_date)->format('Y-m-d') : '') }}">

                        @error('due_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-orange">
                        <i class="bi bi-check-circle me-1"></i>
                        Update Task
                    </button>

                    <a href="{{ url('/manager/tasks/progress') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>
    </div>
</div>

@endsection
