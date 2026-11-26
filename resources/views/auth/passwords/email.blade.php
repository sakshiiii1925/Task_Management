
@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

<div class="row justify-content-center mt-5">

    <div class="col-md-5 col-lg-4">

        <div class="task-card">

            <div class="text-center mb-4">

                <div class="dashboard-icon mx-auto">
                    <i class="bi bi-envelope-lock"></i>
                </div>

                <h2 class="page-title">Forgot Password?</h2>

                <p class="text-muted">
                    Enter your registered email address.
                    We will send you a password reset link.
                </p>

            </div>

            @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">

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
                        placeholder="Enter your registered email"
                        required
                    >

                </div>

                <button type="submit" class="btn btn-orange w-100">
                    <i class="bi bi-envelope me-1"></i>
                    Send Password Reset Link
                </button>

                <div class="text-center mt-3">

                    <a href="{{ url('/login') }}"
                       style="color: #e11d48;">
                        Back to Login
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection
