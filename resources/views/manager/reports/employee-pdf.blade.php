
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employee Monthly Report</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #27272a;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #e11d48;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .header h1 {
            color: #e11d48;
            margin-bottom: 5px;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }

        .summary td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
            width: 25%;
        }

        .number {
            font-size: 22px;
            font-weight: bold;
            color: #e11d48;
        }

        table.tasks {
            width: 100%;
            border-collapse: collapse;
        }

        table.tasks th,
        table.tasks td {
            border: 1px solid #ddd;
            padding: 9px;
            text-align: left;
        }

        table.tasks th {
            background: #27272a;
            color: white;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            color: #777;
            font-size: 10px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h1>Employee Monthly Performance Report</h1>

        <p>Task Manager</p>

        <h3>{{ $employee->name }}</h3>

        <p>Report Month: {{ str_replace('_', ' ', $monthName) }}</p>
    </div>

    <h3>Performance Summary</h3>

    <table class="summary">
        <tr>
            <td>
                <div class="number">{{ $totalTasks }}</div>
                Total Assigned
            </td>

            <td>
                <div class="number">{{ $completedTasks }}</div>
                Completed
            </td>

            <td>
                <div class="number">{{ $inProgressTasks }}</div>
                In Progress
            </td>

            <td>
                <div class="number">{{ $overdueTasks }}</div>
                Overdue
            </td>
        </tr>
    </table>

    <p><strong>Pending Tasks:</strong> {{ $pendingTasks }}</p>

    <h3>Task Details</h3>

    <table class="tasks">

        <thead>
            <tr>
                <th>Task ID</th>
                <th>Task Title</th>
                <th>Status</th>
                <th>Due Date</th>
            </tr>
        </thead>

        <tbody>

            @forelse($tasks as $task)

                <tr>
                    <td>{{ $task->id }}</td>

                    <td>{{ $task->title }}</td>

                    <td>{{ $task->status }}</td>

                    <td>
                        {{ $task->due_date
                            ? \Carbon\Carbon::parse($task->due_date)->format('d-m-Y')
                            : 'Not specified' }}
                    </td>
                </tr>

            @empty

                <tr>
                    <td colspan="4" style="text-align:center;">
                        No tasks found for this month.
                    </td>
                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">
        Generated on {{ now()->format('d-m-Y h:i A') }}
    </div>

</body>
</html>
