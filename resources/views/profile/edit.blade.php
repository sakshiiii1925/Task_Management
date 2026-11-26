
@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<h2 class="page-title mb-4">
    <i class="bi bi-person-circle me-2"></i>
    My Profile
</h2>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row justify-content-center">

    <div class="col-md-7">

        <div class="task-card">

            <div class="text-center mb-4">

                <div class="dashboard-icon mx-auto">
                    <i class="bi bi-person-fill"></i>
                </div>

                <h4>{{ $user->name }}</h4>

                <span class="badge bg-danger">
                    {{ ucfirst($user->role) }}
                </span>

            </div>

            <form action="{{ route('profile.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">

                    <label class="form-label">
                        Full Name
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           value="{{ old('name', $user->name) }}">

                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input type="email"
                           name="email"
                           class="form-control"
                           value="{{ old('email', $user->email) }}">

                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <hr>

                <h5 class="mb-3">
                    Change Password
                </h5>

                <p class="text-muted">
                    Leave these fields empty if you don't want to change your password.
                </p>

               
<!-- New Password -->
<div class="mb-3">

    <label class="form-label">
        New Password
    </label>

    <div class="input-group">

        <input
            type="password"
            name="password"
            id="newPassword"
            class="form-control"
            placeholder="Enter new password"
        >

        <button
            class="btn btn-outline-secondary"
            type="button"
            id="toggleNewPassword"
        >
            <i class="bi bi-eye" id="newPasswordEye"></i>
        </button>

    </div>

    @error('password')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


                <!-- Confirm Password -->
                  <div class="mb-4">
    <label class="form-label fw-semibold">
         Confirm Password
    </label>

    <div class="input-group">
       <input
    type="password"
    name="password_confirmation"
    id="password"
    class="form-control"
    placeholder="Confirm new password"
>

        <button
            class="btn btn-outline-secondary"
            type="button"
            id="togglePassword"
            aria-label="Show password"
        >
            <i class="bi bi-eye" id="eyeIcon"></i>
        </button>
    </div>
</div>
                <button type="submit" class="btn btn-orange">
                    <i class="bi bi-save me-1"></i>
                    Save Changes
                </button>

                <a href="{{ url('/' . Auth::user()->role . '/dashboard') }}"
                   class="btn btn-secondary">
                    Back to Dashboard
                </a>

            </form>

        </div>

    </div>

</div>
<script>
    
// New Password eye icon
document.getElementById('toggleNewPassword').addEventListener('click', function () {

    const password = document.getElementById('newPassword');
    const eyeIcon = document.getElementById('newPasswordEye');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }

});

// Confirm Password eye icon
document.getElementById('togglePassword').addEventListener('click', function () {

    const password = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    if (password.type === 'password') {
        password.type = 'text';
        eyeIcon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        password.type = 'password';
        eyeIcon.classList.replace('bi-eye-slash', 'bi-eye');
    }

});

</script>
@endsection
