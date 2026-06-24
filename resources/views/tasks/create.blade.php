<!DOCTYPE html>
<html>
<head>
    <title>Create Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h2>Add Task</h2>

    <form method="POST" action="{{ route('tasks.store') }}">

        @csrf

        <div class="mb-3">
            <label>Title</label>

            <input type="text"
                   name="title"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>

            <textarea name="description"
                      class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Priority</label>

            <select name="priority"
                    class="form-control">

                <option value="Low">Low</option>
                <option value="Medium">Medium</option>
                <option value="High">High</option>

            </select>
        </div>

        <div class="mb-3">
            <label>Status</label>

            <select name="status"
                    class="form-control">

                <option value="Pending">Pending</option>
                <option value="Completed">Completed</option>

            </select>
        </div>

        <button type="submit"
                class="btn btn-success">
            Save Task
        </button>

    </form>

</div>

</body>
</html>