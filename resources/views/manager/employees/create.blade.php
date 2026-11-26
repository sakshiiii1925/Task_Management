
@extends('layouts.app')

@section('title', 'Add Employee')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="task-card">

            <h2 class="page-title mb-4">Add New Employee</h2>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/manager/employees') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Employee Name</label>
                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        placeholder="Enter employee name"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Address</label>
                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter employee email"
                        required>
                </div>

                <div class="mb-4">
    <label class="form-label">Password</label>

    <div class="input-group">
        <input
            type="password"
            name="password"
            id="employeePassword"
            class="form-control"
            placeholder="Create employee password"
            required>

        <button
            class="btn btn-outline-secondary"
            type="button"
            id="toggleEmployeePassword"
            aria-label="Show password">
            <i class="bi bi-eye" id="employeeEyeIcon"></i>
        </button>
    </div>
</div>

                <button type="submit" class="btn btn-orange w-100">
                    Add Employee
                </button>

                <a href="{{ url('/manager/dashboard') }}"
                   class="btn btn-outline-secondary w-100 mt-2">
                    Cancel
                </a>

            </form>

        </div>

    </div>
</div>
<script>
    document.getElementById('toggleEmployeePassword').addEventListener('click', function () {

        const password = document.getElementById('employeePassword');
        const eyeIcon = document.getElementById('employeeEyeIcon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
            this.setAttribute('aria-label', 'Hide password');
        } else {
            password.type = 'password';
            eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
            this.setAttribute('aria-label', 'Show password');
        }

    });
</script>
@endsection
