
@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="row justify-content-center mt-5">

    <div class="col-md-5 col-lg-4">

        <div class="task-card">

            <div class="text-center mb-4">

                <div class="dashboard-icon mx-auto">
                    <i class="bi bi-shield-lock"></i>
                </div>

                <h2 class="page-title">Reset Password</h2>

                <p class="text-muted">
                    Create a new password for your account.
                </p>

            </div>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update') }}"
                  method="POST">

                @csrf

                <input type="hidden"
                       name="token"
                       value="{{ $token }}">

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $email) }}"
                        required
                    >

                </div>

                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        New Password
                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            name="password"
                            id="newPassword"
                            class="form-control"
                            placeholder="Enter new password"
                            required
                        >

                        <button type="button"
                                class="btn btn-outline-secondary"
                                id="toggleNewPassword">
                            <i class="bi bi-eye" id="newEye"></i>
                        </button>

                    </div>

                </div>

                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Confirm New Password
                    </label>

                    <div class="input-group">

                        <input
                            type="password"
                            name="password_confirmation"
                            id="confirmPassword"
                            class="form-control"
                            placeholder="Confirm new password"
                            required
                        >

                        <button type="button"
                                class="btn btn-outline-secondary"
                                id="toggleConfirmPassword">
                            <i class="bi bi-eye" id="confirmEye"></i>
                        </button>

                    </div>

                </div>

                <button type="submit"
                        class="btn btn-orange w-100">
                    Reset Password
                </button>

            </form>

        </div>

    </div>

</div>

<script>
function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
}

document.getElementById('toggleNewPassword')
    .addEventListener('click', function () {
        togglePassword('newPassword', 'newEye');
    });

document.getElementById('toggleConfirmPassword')
    .addEventListener('click', function () {
        togglePassword('confirmPassword', 'confirmEye');
    });
</script>

@endsection
