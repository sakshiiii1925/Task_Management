
@extends('layouts.app')

@section('title', 'Assign Task')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-7">

        <div class="task-card">

            <h2 class="page-title mb-4">Assign Task to Employee</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/manager/tasks') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Task Title</label>
                    <input
                        type="text"
                        name="title"
                        class="form-control"
                        value="{{ old('title') }}"
                        placeholder="Enter task title"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea
                        name="description"
                        class="form-control"
                        rows="4"
                        placeholder="Enter task description">{{ old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Assign Employee</label>

                    <select name="assigned_to" class="form-select" required>
                        <option value="">Select Employee</option>

                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ old('assigned_to') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }} ({{ $employee->email }})
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Task Status</label>

                    <select name="status" class="form-select" required>
                        <option value="Pending"
                            {{ old('status', 'Pending') == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="In Progress"
                            {{ old('status') == 'In Progress' ? 'selected' : '' }}>
                            In Progress
                        </option>

                        <option value="Completed"
                            {{ old('status') == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Due Date</label>

                    <input
                        type="date"
                        name="due_date"
                        class="form-control"
                        value="{{ old('due_date') }}">
                </div>

                <button type="submit" class="btn btn-orange w-100">
                    Assign Task
                </button>

                <a href="{{ url('/manager/dashboard') }}"
                   class="btn btn-outline-secondary w-100 mt-2">
                    Cancel
                </a>

            </form>

        </div>

    </div>
</div>

@endsection
