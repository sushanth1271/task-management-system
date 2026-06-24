<!DOCTYPE html>
<html>
<head>
    <title>Edit Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Edit Task</h2>

    <form method="POST"
          action="{{ route('tasks.update', $task->id) }}">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Title</label>

            <input type="text"
                   name="title"
                   value="{{ $task->title }}"
                   class="form-control">

        </div>

        <div class="mb-3">

            <label>Description</label>

            <textarea name="description"
                      class="form-control">{{ $task->description }}</textarea>

        </div>

        <div class="mb-3">

            <label>Priority</label>

            <select name="priority"
                    class="form-control">

                <option value="Low"
                {{ $task->priority == 'Low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="Medium"
                {{ $task->priority == 'Medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="High"
                {{ $task->priority == 'High' ? 'selected' : '' }}>
                    High
                </option>

            </select>

        </div>

        <div class="mb-3">

            <label>Status</label>

            <select name="status"
                    class="form-control">

                <option value="Pending"
                {{ $task->status == 'Pending' ? 'selected' : '' }}>
                    Pending
                </option>

                <option value="Completed"
                {{ $task->status == 'Completed' ? 'selected' : '' }}>
                    Completed
                </option>

            </select>

        </div>

        <button type="submit"
                class="btn btn-primary">
            Update Task
        </button>

    </form>

</div>

</body>
</html>