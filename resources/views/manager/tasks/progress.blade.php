
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Task Progress</h2>

<!-- Task Summary Cards -->

<div class="row g-3 mt-2 mb-4">

    <!-- Total Tasks -->
    <div class="col-md-6 col-lg-3">
        <div class="task-card h-100">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-1">Total Tasks</p>
                    <h2 class="fw-bold mb-0">
                        {{ $totalTasks }}
                    </h2>
                </div>

                <div class="dashboard-icon">
                    <i class="bi bi-clipboard-check"></i>
                </div>

            </div>
        </div>
    </div>

    <!-- Completed Tasks -->
    <div class="col-md-6 col-lg-3">
        <div class="task-card h-100">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-1">Completed</p>
                    <h2 class="fw-bold text-primary mb-0">
                        {{ $completedTasks }}
                    </h2>
                </div>

                <div class="dashboard-icon">
                    <i class="bi bi-check-circle"></i>
                </div>

            </div>
        </div>
    </div>

    <!-- In Progress Tasks -->
    <div class="col-md-6 col-lg-3">
        <div class="task-card h-100">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-1">In Progress</p>
                    <h2 class="fw-bold text-success mb-0">
                        {{ $inProgressTasks }}
                    </h2>
                </div>

                <div class="dashboard-icon">
                    <i class="bi bi-hourglass-split"></i>
                </div>

            </div>
        </div>
    </div>

    <!-- Overdue Tasks -->
    <div class="col-md-6 col-lg-3">
        <div class="task-card h-100">
            <div class="d-flex justify-content-between align-items-center">

                <div>
                    <p class="text-muted mb-1">Overdue Tasks</p>
                    <h2 class="fw-bold text-danger mb-0">
                        {{ $dueTasks }}
                    </h2>
                </div>

                <div class="dashboard-icon">
                    <i class="bi bi-exclamation-circle"></i>
                </div>

            </div>
        </div>
    </div>

</div>


    <div class="card p-3 mt-3">

        <div class="table-responsive">

            <table class="table table-bordered table-hover">

                <thead>
                    <tr>
                        <th>Task ID</th>
                        <th>Task Title</th>
                        <th>Assigned Employee</th>
                        <th>Status</th>
                        <th>Due Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($tasks as $task)

                        <tr>
                            <td>{{ $task->id }}</td>

                            <td>{{ $task->title }}</td>

                            <td>
                                {{ $task->assignedEmployee?->name ?? 'Not Assigned' }}
                            </td>

                          <td>
    @if($task->status == 'Pending')
        <span class="badge bg-warning text-dark">
            Pending
        </span>

    @elseif($task->status == 'In Progress')
        <span class="badge bg-success">
            In Progress
        </span>

    @elseif($task->status == 'Completed')
        <span class="badge bg-primary">
            Completed
        </span>
    @endif
</td>

                            <td>{{ $task->due_date ?? 'Not specified' }}</td>
                            <td>
    <div class="d-flex gap-2">

        <!-- Edit Button -->
        <a href="{{ url('/manager/tasks/' . $task->id . '/edit') }}"
           class="btn btn-sm btn-outline-primary">
            <i class="bi bi-pencil-square"></i> Edit
        </a>

        <!-- Delete Button -->
        <form action="{{ url('/manager/tasks/' . $task->id) }}"
              method="POST"
              class="delete-task-form">

            @csrf
            @method('DELETE')

            <button type="button"
                    class="btn btn-sm btn-danger delete-task-btn">
                <i class="bi bi-trash"></i> Delete
            </button>

        </form>

    </div>
</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center">
                                No tasks found.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection
