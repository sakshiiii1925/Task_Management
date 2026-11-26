
@extends('layouts.app')

@section('title', 'Login')

@section('content')

<div class="row justify-content-center mt-5">

    <div class="col-md-5 col-lg-4">

        <div class="task-card">

            <div class="text-center mb-4">
                <h2 class="page-title">Welcome Back!</h2>
                <p class="text-muted">
                    Login to your Task Manager account.
                </p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                        placeholder="Enter your email"
                        required
                    >
                </div>

               <div class="mb-4">
    <label class="form-label fw-semibold">
        Password
    </label>

    <div class="input-group">
        <input
            type="password"
            name="password"
            id="password"
            class="form-control"
            placeholder="Enter your password"
            required
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
<div class="text-end mb-3">
    <a href="{{ url('/forgot-password') }}"
       class="text-decoration-none"
       style="color: #e11d48; font-weight: 600;">

        Forgot Password?

    </a>
</div>

                <button type="submit"
                        class="btn btn-orange w-100">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {

        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('bi-eye');
            eyeIcon.classList.add('bi-eye-slash');
            this.setAttribute('aria-label', 'Hide password');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash');
            eyeIcon.classList.add('bi-eye');
            this.setAttribute('aria-label', 'Show password');
        }

    });
</script>
@endsection
