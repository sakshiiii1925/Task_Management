
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

                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter your password"
                        required
                    >
                </div>

                <button type="submit"
                        class="btn btn-orange w-100">
                    Login
                </button>

            </form>

        </div>

    </div>

</div>

@endsection
