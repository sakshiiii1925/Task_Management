
@extends('layouts.app')

@section('title', 'Edit Employee')

@section('content')

<h2 class="page-title mb-4">Edit Employee</h2>

<div class="task-card">

    <form action="{{ route('manager.employees.update', $employee->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label class="form-label">Employee Name</label>

            <input type="text"
                   name="name"
                   class="form-control"
                   value="{{ old('name', $employee->name) }}">

            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label">Employee Email</label>

            <input type="email"
                   name="email"
                   class="form-control"
                   value="{{ old('email', $employee->email) }}">

            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror

        </div>

        <button type="submit" class="btn btn-orange">
            Update Employee
        </button>

        <a href="{{ url('/manager/employees') }}"
           class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection
