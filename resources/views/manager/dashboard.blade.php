
@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<div class="container">

    <h2 class="page-title mb-4">Manager Dashboard</h2>

    <div class="task-card mb-4">
        <h4>Welcome, Manager!</h4>
        <p class="text-muted mb-0">
            Manage employees, assign tasks and monitor progress.
        </p>
    </div>

    {{-- Dashboard Summary --}}
    <h4 class="mb-3">Dashboard Summary</h4>

    <div class="row">

        <div class="col-md-3 mb-3">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h6>Total Employees</h6>
                <h3>{{ $totalEmployees }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-list-task"></i>
                </div>
                <h6>Total Tasks</h6>
                <h3>{{ $totalTasks }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <h6>Completed Tasks</h6>
                <h3>{{ $completedTasks }}</h3>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>
                <h6>Pending Tasks</h6>
                <h3>{{ $pendingTasks }}</h3>
            </div>
        </div>

    </div>

    {{-- Completion Percentage --}}
    <div class="task-card mb-4">
        <h5>Overall Task Completion</h5>

        <h2>{{ $completionPercentage }}%</h2>

        <div class="progress" style="height: 18px;">
            <div class="progress-bar bg-success"
                 role="progressbar"
                 style="width: {{ $completionPercentage }}%;"
                 aria-valuenow="{{ $completionPercentage }}"
                 aria-valuemin="0"
                 aria-valuemax="100">
            </div>
        </div>

        <small class="text-muted">
            {{ $completedTasks }} completed out of {{ $totalTasks }} total tasks
        </small>
    </div>

    {{-- Charts --}}
    <div class="row mb-4">

        <div class="col-md-5 mb-4">
            <div class="task-card h-100">
                <h5 class="mb-3">Task Status Summary</h5>
                <canvas id="taskStatusChart"></canvas>
            </div>
        </div>

        <div class="col-md-7 mb-4">
            <div class="task-card h-100">
                <h5 class="mb-3">Employee Task Performance</h5>
                <canvas id="employeePerformanceChart"></canvas>
            </div>
        </div>

    </div>

    {{-- Existing Dashboard Options --}}
    <h4 class="mb-3">Management Options</h4>

    <div class="row">

        <div class="col-md-4 mb-4">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-people-fill"></i>
                </div>
                <h5>Manage Employees</h5>
                <p>Add and manage employees.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ url('/manager/employees/create') }}" class="btn btn-orange">Add Employee</a>
                    <a href="{{ url('/manager/employees') }}" class="btn btn-outline-primary">View Employees</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-clipboard-check-fill"></i>
                </div>
                <h5>Assign Tasks</h5>
                <p>Create tasks and assign them to employees.</p>
                <div class="d-flex gap-2 flex-wrap">
                    <a href="{{ url('/manager/tasks/create') }}" class="btn btn-orange">Assign Task</a>
                    <a href="{{ url('/manager/tasks/progress') }}" class="btn btn-outline-primary">View All Tasks</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <h5>Task Progress</h5>
                <p>Monitor employee task progress.</p>
                <a href="{{ url('/manager/tasks/progress') }}" class="btn btn-orange">View Task Progress</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-file-earmark-bar-graph"></i>
                </div>
                <h5>Employee Monthly Report</h5>
                <p>Generate monthly employee performance reports.</p>
                <a href="{{ route('manager.reports.employee') }}" class="btn btn-orange">Generate Report</a>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="task-card h-100">
                <div class="dashboard-icon">
                    <i class="bi bi-people"></i>
                </div>
                <h5>All Employees Monthly Report</h5>
                <p>Compare monthly performance of all employees.</p>
                <a href="{{ url('/manager/reports/all-employees?month=' . now()->format('Y-m')) }}"
                   class="btn btn-orange">View All Reports</a>
            </div>
        </div>

    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Task Status Doughnut Chart
    new Chart(document.getElementById('taskStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Completed', 'Pending', 'In Progress'],
            datasets: [{
                data: [
                    @json($completedTasks),
                    @json($pendingTasks),
                    @json($inProgressTasks)
                ],
                backgroundColor: [
                    '#16a34a',
                    '#e11d48',
                    '#f59e0b'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true
        }
    });

    // Employee Performance Bar Chart
    new Chart(document.getElementById('employeePerformanceChart'), {
        type: 'bar',
        data: {
            labels: @json($employeePerformance->pluck('name')),
            datasets: [
                {
                    label: 'Assigned Tasks',
                    data: @json($employeePerformance->pluck('assigned_tasks_count')),
                    backgroundColor: '#e11d48'
                },
                {
                    label: 'Completed Tasks',
                    data: @json($employeePerformance->pluck('completed_tasks_count')),
                    backgroundColor: '#16a34a'
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

});
</script>

@endsection
