
@extends('layouts.app')

@section('title', 'Manager Dashboard')

@section('content')

<div class="container">
    <h2 class="page-title mb-4">Manager Dashboard</h2>

    <div class="task-card">
        <h4>Welcome, Manager!</h4>
        <p class="text-muted">
            Manage employees, assign tasks and monitor progress.
        </p>
    </div>

    <div class="row mt-4">

        <div class="col-md-4">
            <div class="task-card">
                <div class="dashboard-icon">
    <i class="bi bi-people-fill"></i>
</div>
                <h5>Manage Employees</h5>
                <p>Add and manage employees.</p>
               <div class="d-flex gap-2 flex-wrap">

    <a href="{{ url('/manager/employees/create') }}"
       class="btn btn-orange">
        Add Employee
    </a>

    <a href="{{ url('/manager/employees') }}"
       class="btn btn-outline-primary">
        View Employees
    </a>

</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-card">
                <div class="dashboard-icon">
    <i class="bi bi-clipboard-check-fill"></i>
</div>
                <h5>Assign Tasks</h5>
                <p>Create tasks and assign them to employees.</p>
              <div class="d-flex gap-2 flex-wrap">

    <a href="{{ url('/manager/tasks/create') }}"
       class="btn btn-orange">
        Assign Task
    </a>

    <a href="{{ url('/manager/tasks/progress') }}"
       class="btn btn-outline-primary">
        View All Tasks
    </a>

</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="task-card">
                 <div class="dashboard-icon">
    <i class="bi bi-graph-up-arrow"></i>
</div>
                <h5>Task Progress</h5>
                <p>Monitor employee task progress.</p>
                <a href="{{ url('/manager/tasks/progress') }}"
   class="btn btn-orange">
    View Task Progress
</a>
            </div>
        </div>

    </div>
</div>

@endsection
