
@extends('layouts.app')

@section('title', 'Employee Monthly Report')

@section('content')

<div class="container mt-4">

    <h2 class="page-title mb-4">Employee Monthly Report</h2>

    {{-- Employee and Month Filter --}}
    <div class="task-card mb-4">

        <h5 class="mb-3">Generate Report</h5>

        <form action="{{ route('manager.reports.employee') }}" method="GET">

            <div class="row">

                <div class="col-md-5 mb-3">
                    <label class="form-label">Select Employee</label>

                    <select name="employee_id" class="form-select" required>
                        <option value="">Choose Employee</option>

                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}"
                                {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label class="form-label">Select Month</label>

                    <input type="month"
                           name="month"
                           class="form-control"
                           value="{{ request('month', now()->format('Y-m')) }}"
                           required>
                </div>

                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-orange w-100">
                        <i class="bi bi-file-earmark-bar-graph me-1"></i>
                        Generate Report
                    </button>
                </div>

            </div>

        </form>
    </div>


    {{-- Report Result --}}
    @if($report)

        <div class="task-card">

            
<div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

    <div>
        <h4>{{ $report['employee']->name }}</h4>

        <p class="text-muted mb-0">
            Monthly Report:
            {{ \Carbon\Carbon::createFromFormat('Y-m', $report['month'])->format('F Y') }}
        </p>
    </div>

    <a href="{{ route('manager.reports.employee.pdf', [
        'employee_id' => $report['employee']->id,
        'month' => $report['month']
    ]) }}"
       class="btn btn-orange">

        <i class="bi bi-file-earmark-pdf me-1"></i>
        Download PDF

    </a>

</div>


            {{-- Summary Cards --}}
            <div class="row g-3 mb-4">

                <div class="col-md-3">
                    <div class="dashboard-icon">
                        <i class="bi bi-list-task"></i>
                    </div>
                    <h3>{{ $report['totalTasks'] }}</h3>
                    <p>Total Assigned</p>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-icon">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <h3>{{ $report['completedTasks'] }}</h3>
                    <p>Completed</p>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3>{{ $report['inProgressTasks'] }}</h3>
                    <p>In Progress</p>
                </div>

                <div class="col-md-3">
                    <div class="dashboard-icon">
                        <i class="bi bi-exclamation-circle"></i>
                    </div>
                    <h3>{{ $report['overdueTasks'] }}</h3>
                    <p>Overdue</p>
                </div>

            </div>

            
<hr>

{{-- Employee Performance Chart --}}
<h5 class="mb-3">Employee Performance Chart</h5>

<div class="task-card mb-4">
    <div style="height: 320px; position: relative;">
        <canvas id="employeePerformanceChart"></canvas>
    </div>
</div>

{{-- Task Details --}}
<h5 class="mb-3">Task Details</h5>


            <div class="table-responsive">

                <table class="table table-bordered table-hover">

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

                                <td>
                                    @if($task->status == 'Completed')
                                        <span class="badge bg-primary">Completed</span>
                                    @elseif($task->status == 'In Progress')
                                        <span class="badge bg-success">In Progress</span>
                                    @elseif($task->status == 'Pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">
                                            {{ $task->status }}
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    {{ $task->due_date
                                        ? \Carbon\Carbon::parse($task->due_date)->format('d-m-Y')
                                        : 'Not specified' }}
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No tasks assigned during this month.
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    @endif

</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const chartElement = document.getElementById('employeePerformanceChart');

    if (!chartElement || typeof Chart === 'undefined') {
        return;
    }

    new Chart(chartElement, {
        type: 'bar',

        data: {
            labels: [
                'Completed',
                'Pending',
                'In Progress',
                'Overdue'
            ],

            datasets: [{
                label: 'Number of Tasks',

                data: [
    {{ $report['completedTasks'] ?? 0 }},
    {{ $report['pendingTasks'] ?? 0 }},
    {{ $report['inProgressTasks'] ?? 0 }},
    {{ $report['overdueTasks'] ?? 0 }}
],

                backgroundColor: [
                    '#16a34a',
                    '#f59e0b',
                    '#2563eb',
                    '#dc2626'
                ],

                borderRadius: 6
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            plugins: {
                legend: {
                    display: false
                }
            },

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    },
                    title: {
                        display: true,
                        text: 'Number of Tasks'
                    }
                }
            }
        }
    });

});
</script>

@endsection
