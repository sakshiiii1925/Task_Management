
@extends('layouts.app')

@section('content')

<div class="container mt-4">

    <h2>My Assigned Tasks</h2>
@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    @forelse($tasks as $task)

        <div class="card mb-3 p-3">

            <h4>{{ $task->title }}</h4>

            <p>{{ $task->description }}</p>

           
<form action="{{ url('/employee/tasks/' . $task->id . '/status') }}"
      method="POST">

    @csrf

    <label><strong>Update Status:</strong></label>

    <select name="status" class="form-select mb-2">

        <option value="Pending"
            {{ $task->status == 'Pending' ? 'selected' : '' }}>
            Pending
        </option>

        <option value="In Progress"
            {{ $task->status == 'In Progress' ? 'selected' : '' }}>
            In Progress
        </option>

        <option value="Completed"
            {{ $task->status == 'Completed' ? 'selected' : '' }}>
            Completed
        </option>

    </select>

    <button type="submit" class="btn btn-orange">
        Update Status
    </button>

</form>


            <p>
                <strong>Due Date:</strong>
                {{ $task->due_date ?? 'Not specified' }}
            </p>

        </div>

    @empty

        <p>No tasks assigned to you yet.</p>

    @endforelse

</div>

@endsection
