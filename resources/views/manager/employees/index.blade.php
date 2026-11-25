@extends('layouts.app')

@section('title', 'Manage Employees')

@section('content')

<h2 class="page-title mb-4">Manage Employees</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="task-card">

    <a href="{{ url('/manager/employees/create') }}"
       class="btn btn-orange mb-3">
        Add New Employee
    </a>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @forelse($employees as $employee)
                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        No employees found.
                    </td>
                </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection
