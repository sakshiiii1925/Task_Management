
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

    <!-- Search Employee -->
    <form action="{{ url('/manager/employees') }}"
          method="GET"
          class="mb-3">

        <div class="input-group">

            <input type="text"
                   name="search"
                   class="form-control"
                   placeholder="Search by employee name or email..."
                   value="{{ request('search') }}">

            <button type="submit" class="btn btn-orange">
                Search
            </button>

            <a href="{{ url('/manager/employees') }}"
               class="btn btn-secondary">
                Reset
            </a>

        </div>

    </form>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>

            @forelse($employees as $employee)

                <tr>
                    <td>{{ $employee->id }}</td>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->email }}</td>

                    <td>

                        <a href="{{ route('manager.employees.edit', $employee->id) }}"
                           class="btn btn-sm btn-primary">
                            Edit
                        </a>

                        <form action="{{ route('manager.employees.destroy', $employee->id) }}"
                              method="POST"
                              style="display:inline;"
                              onsubmit="return confirm('Are you sure you want to delete this employee?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn btn-sm btn-danger">
                                Delete
                            </button>

                        </form>

                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" class="text-center">
                        No employees found.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <!-- Pagination -->
    <div class="mt-3">
        {{ $employees->links() }}
    </div>

</div>

@endsection
