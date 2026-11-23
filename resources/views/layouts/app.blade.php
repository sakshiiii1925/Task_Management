
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Task Manager')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #172033;
        }

        .navbar-brand {
            color: white;
            font-weight: bold;
            font-size: 23px;
        }

        .navbar-brand:hover {
            color: #f59e0b;
        }

        .nav-link {
            color: white;
            margin-left: 15px;
        }

        .nav-link:hover {
            color: #f59e0b;
        }

        .main-container {
            padding: 35px 20px;
        }

        .page-title {
            color: #172033;
            font-weight: bold;
        }

        .task-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 18px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.05);
        }

        .btn-orange {
            background-color: #f59e0b;
            color: white;
            border: none;
        }

        .btn-orange:hover {
            background-color: #d97706;
            color: white;
        }
    </style>
</head>

<body>

    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/tasks') }}">
                Task Manager
            </a>

            <button class="navbar-toggler bg-light" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tasks') }}">
                            My Tasks
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/tasks/create') }}">
                            Add Task
                        </a>
                    </li>

                </ul>
            </div>

        </div>
    </nav>

    <!-- Page Content -->
    <div class="container main-container">

        @yield('content')

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
