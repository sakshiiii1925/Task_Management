
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>Task Progress</h2>

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
                        </tr>

                    @empty

                        <tr>
                            <td colspan="5" class="text-center">
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
