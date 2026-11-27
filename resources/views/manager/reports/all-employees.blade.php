
@extends('layouts.app')

@section('title', 'All Employees Monthly Report')

@section('content')

<div class="container mt-4">

    <h2 class="page-title mb-4">All Employees Monthly Report</h2>

    {{-- Month Filter --}}
    <div class="task-card mb-4">

        <h5 class="mb-3">Select Report Month</h5>

        <form action="{{ route('manager.reports.all-employees') }}" method="GET">

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">Select Month</label>
                    <input type="month"
                           name="month"
                           class="form-control"
                           value="{{ $month }}"
                           required>
                </div>

                <div class="col-md-3 mb-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-orange w-100">
                        <i class="bi bi-search me-1"></i>
                        Generate Report
                    </button>
                </div>

            </div>

        </form>

    </div>


    {{-- Report Table --}}
    <div class="task-card">

       <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

    <div>
        <h4>Employee Performance Summary</h4>

        <p class="text-muted">
            Report Month:
            {{ \Carbon\Carbon::createFromFormat('Y-m', $month)->format('F Y') }}
        </p>
    </div>

    <a href="{{ url('/manager/reports/all-employees/excel?month=' . $month) }}"
       class="btn btn-success">

        <i class="bi bi-file-earmark-excel me-1"></i>
        Download Excel

    </a>

</div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>Employee Name</th>
                        <th>Total Assigned</th>
                        <th>Completed</th>
                        <th>Pending</th>
                        <th>In Progress</th>
                        <th>Overdue</th>
                        <th>Completion Percentage</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($report as $item)

                        <tr>

                            <td>
                                <strong>{{ $item['employee']->name }}</strong>
                            </td>

                            <td>
                                {{ $item['totalTasks'] }}
                            </td>

                            <td>
                                <span class="badge bg-primary">
                                    {{ $item['completedTasks'] }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-warning text-dark">
                                    {{ $item['pendingTasks'] }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-success">
                                    {{ $item['inProgressTasks'] }}
                                </span>
                            </td>

                            <td>
                                <span class="badge bg-danger">
                                    {{ $item['overdueTasks'] }}
                                </span>
                            </td>
                            <td>
    <div class="progress" style="height: 22px;">
        <div class="progress-bar bg-success"
             role="progressbar"
             style="width: {{ $item['completionPercentage'] }}%;"
             aria-valuenow="{{ $item['completionPercentage'] }}"
             aria-valuemin="0"
             aria-valuemax="100">
            {{ $item['completionPercentage'] }}%
        </div>
    </div>
</td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                No employees found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
