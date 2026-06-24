<!DOCTYPE html>
<html>
<head>
    <title>View Task</title>
</head>
<body>

<h2>{{ $task->title }}</h2>

<p>{{ $task->description }}</p>

<p>Priority: {{ $task->priority }}</p>

<p>Status: {{ $task->status }}</p>

<a href="{{ route('tasks.index') }}">
Back
</a>

</body>
</html>