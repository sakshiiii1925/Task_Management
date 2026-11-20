<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
</head>
<body>

    <h1>My Tasks</h1>

    @forelse($tasks as $task)

        <h3>{{ $task->title }}</h3>
        <p>{{ $task->description }}</p>
        <p>Status: {{ $task->status }}</p>

        <hr>

    @empty

        <p>No tasks found!</p>

    @endforelse

</body>
</html>