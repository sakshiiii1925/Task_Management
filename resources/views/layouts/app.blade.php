
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Manager')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="icon" type="image/png" href="{{ asset('images/app-logo.png') }}">
<style>
    :root {
        --primary: #e11d48;
        --primary-hover: #be123c;
        --dark: #27272a;
        --dark-secondary: #3f3f46;
        --background: #fff1f2;
        --card: #ffffff;
        --border: #ffe4e6;
        --text: #27272a;
        --muted: #71717a;
    }

    /* Global */
    body {
        background-color: var(--background);
        font-family: Arial, sans-serif;
        color: var(--text);
    }

    a {
        text-decoration: none;
    }

    /* Navbar */
    .navbar {
        background-color: var(--dark);
        padding: 12px 0;
    }

    .navbar-brand {
        color: #ffffff;
        font-weight: bold;
        font-size: 23px;
    }

    .navbar-brand:hover {
        color: #fda4af;
    }

    .nav-link {
        color: #ffffff;
        margin-left: 15px;
        font-weight: 500;
    }

    .nav-link:hover {
        color: #fda4af;
    }

    /* Main Container */
    .main-container {
        padding: 35px 20px;
    }

    /* Page Heading */
    .page-title {
        color: var(--dark);
        font-weight: bold;
    }

    /* Cards */
    .task-card {
        background: var(--card);
        border-radius: 14px;
        padding: 22px;
        margin-bottom: 18px;
        border: 1px solid var(--border);
        box-shadow: 0 4px 15px rgba(39, 39, 42, 0.06);
    }

    /* Buttons */
    .btn-orange {
        background-color: var(--primary);
        color: #ffffff;
        border: 1px solid var(--primary);
        font-weight: 500;
        border-radius: 7px;
        padding: 9px 16px;
    }

    .btn-orange:hover {
        background-color: var(--primary-hover);
        border-color: var(--primary-hover);
        color: #ffffff;
    }

    .btn-outline-primary {
        color: var(--primary);
        border-color: var(--primary);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary);
        border-color: var(--primary);
        color: #ffffff;
    }

    /* Forms */
    .form-control,
    .form-select {
        border: 1px solid #e4e4e7;
        border-radius: 7px;
        padding: 10px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.15);
    }

    .form-label {
        color: var(--dark);
    }

    /* Tables */
    .table {
        background-color: #ffffff;
        vertical-align: middle;
    }

    .table thead th {
        background-color: #ffe4e6;
        color: var(--dark);
        font-weight: 600;
        padding: 13px;
    }

    .table tbody td {
        padding: 12px;
    }

    /* Status badges */
    .status-pending {
        background-color: #fff1f2;
        color: #be123c;
    }

    .status-progress {
        background-color: #fce7f3;
        color: #9d174d;
    }

    .status-completed {
        background-color: #27272a;
        color: #ffffff;
    }

    /* Alerts */
    .alert-success {
        background-color: #fce7f3;
        border-color: #fbcfe8;
        color: #9d174d;
    }

    /* Login Background */
    .login-background {
        min-height: calc(100vh - 56px);
        margin: -35px -20px;
        padding: 50px 20px;

        background:
            radial-gradient(
                circle at 15% 20%,
                rgba(225, 29, 72, 0.35),
                transparent 35%
            ),
            radial-gradient(
                circle at 85% 80%,
                rgba(190, 18, 60, 0.25),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #18181b,
                #3f1724,
                #881337
            );

        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Login Card */
    .login-card {
        background: rgba(255, 255, 255, 0.98);
        border-radius: 18px;
        padding: 32px;
        box-shadow: 0 15px 45px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .main-container {
            padding: 20px 12px;
        }

        .login-background {
            margin: -20px -12px;
            padding: 30px 15px;
        }

        .login-card {
            padding: 24px;
        }

        .navbar-brand {
            font-size: 20px;
        }
    }

/* ==============================
   PROFESSIONAL CARD ANIMATIONS
============================== */

/* Card entrance animation */
@keyframes cardFadeIn {
    from {
        opacity: 0;
        transform: translateY(25px);
    }

    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Apply animation to cards */
.task-card {
    animation: cardFadeIn 0.7s ease-out both;
    transition:
        transform 0.3s ease,
        box-shadow 0.3s ease,
        border-color 0.3s ease;
}

/* Card hover effect */
.task-card:hover {
    transform: translateY(-7px);
    box-shadow: 0 12px 28px rgba(225, 29, 72, 0.13);
    border-color: #fda4af;
}

/* Dashboard card animation delays */
.row .col-md-4:nth-child(1) .task-card {
    animation-delay: 0.1s;
}

.row .col-md-4:nth-child(2) .task-card {
    animation-delay: 0.2s;
}

.row .col-md-4:nth-child(3) .task-card {
    animation-delay: 0.3s;
}

/* Button animation */
.btn {
    transition:
        transform 0.25s ease,
        box-shadow 0.25s ease,
        background-color 0.25s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 12px rgba(39, 39, 42, 0.15);
}

/* Table row hover animation */
.table tbody tr {
    transition: background-color 0.25s ease;
}

.table tbody tr:hover {
    background-color: #fff1f2;
}

/* Login card entrance animation */
.login-card {
    animation: loginFadeIn 0.8s ease-out both;
}

@keyframes loginFadeIn {
    from {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

/* Respect users who prefer reduced motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
.dashboard-icon {
    width: 58px;
    height: 58px;
    background: #fff1f2;
    color: #e11d48;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin-bottom: 18px;
    transition: all 0.3s ease;
}

.task-card:hover .dashboard-icon {
    background: #e11d48;
    color: #ffffff;
    transform: scale(1.08) rotate(-3deg);
}
.logout-popup {
    border-radius: 20px !important;
    padding: 25px !important;
    box-shadow: 0 15px 45px rgba(39, 39, 42, 0.18);
}

.logout-title {
    font-weight: 700 !important;
}

.logout-confirm,
.logout-cancel {
    border-radius: 8px !important;
    padding: 10px 22px !important;
    font-weight: 600 !important;
}
</style>
    
</head>

<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            @auth
                @if(Auth::user()->role == 'manager')
                    <a class="navbar-brand" href="{{ url('/manager/dashboard') }}">
                        Task Manager
                    </a>
                @else
                    <a class="navbar-brand" href="{{ url('/employee/dashboard') }}">
                        Task Manager
                    </a>
                @endif
            @else
                <a class="navbar-brand" href="{{ url('/login') }}">
                    Task Manager
                </a>
            @endauth

            <button class="navbar-toggler bg-light" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <ul class="navbar-nav ms-auto align-items-lg-center">

                    @auth

                        @if(Auth::user()->role == 'manager')

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/manager/dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/manager/tasks/progress') }}">
                                    All Tasks
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/manager/tasks/create') }}">
                                    Add Task
                                </a>
                            </li>

                        @elseif(Auth::user()->role == 'employee')

                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/employee/dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                        @endif
                        <li class="nav-item">
    <a class="nav-link" href="{{ route('profile.edit') }}">
        <i class="bi bi-person-circle me-1"></i>
        My Profile
    </a>
</li>
<li class="nav-item ms-lg-3">
    <form action="{{ url('/logout') }}" method="POST" id="logoutForm">
        @csrf

        <button type="button" class="btn btn-orange" id="logoutButton">
            <i class="bi bi-box-arrow-right me-1"></i>
            Logout
        </button>
    </form>
</li>

                    @else

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">
                                Login
                            </a>
                        </li>

                    @endauth

                </ul>

            </div>
        </div>
    </nav>

    <div class="container main-container">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.getElementById('logoutButton')?.addEventListener('click', function () {

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to logout from your account?',
            icon: 'warning',

            showCancelButton: true,

            confirmButtonText: 'Yes, Logout',
            cancelButtonText: 'Cancel',

            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#27272a',

            background: '#ffffff',
            color: '#27272a',

            reverseButtons: true,
            focusCancel: true,

            customClass: {
                popup: 'logout-popup',
                title: 'logout-title',
                confirmButton: 'logout-confirm',
                cancelButton: 'logout-cancel'
            }

        }).then((result) => {

            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }

        });

    });
</script>
<script>
document.querySelectorAll('.delete-task-btn').forEach(button => {

    button.addEventListener('click', function () {

        const form = this.closest('.delete-task-form');

        Swal.fire({
            title: 'Delete Task?',
            text: 'This task will be permanently deleted.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#e11d48',
            cancelButtonColor: '#27272a',
            background: '#ffffff',
            color: '#27272a',
            reverseButtons: true
        }).then((result) => {

            if (result.isConfirmed) {
                form.submit();
            }

        });

    });

});
</script>
</body>
</html>
