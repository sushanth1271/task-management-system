<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: radial-gradient(circle at top, #e0e7ff, #f5f7ff);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .task-card {
            width: 100%;
            max-width: 850px;
            background: #fff;
            border-radius: 22px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.12);
        }

        .task-title {
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
            color: #333;
        }

        .form-label {
            font-weight: 600;
            color: #555;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #ddd;
            transition: 0.3s;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102,126,234,0.2);
        }

        textarea {
            min-height: 120px;
        }

        .btn-premium {
            width: 100%;
            padding: 12px;
            border-radius: 12px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
        }

        .btn-save {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
        }

        .btn-save:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102,126,234,0.3);
        }

        .btn-back {
            background: linear-gradient(135deg, #6c757d, #495057);
            color: #fff;
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(108,117,125,0.3);
        }

        .btn-group-custom {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 10px;
        }

        .header-icon {
            font-size: 40px;
            text-align: center;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="task-card">

    <span class="header-icon">✏️</span>

    <h2 class="task-title">Edit Task</h2>

    <form method="POST" action="{{ route('tasks.update', $task->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Task Title</label>
            <input type="text"
                   name="title"
                   value="{{ $task->title }}"
                   class="form-control"
                   placeholder="Enter task title">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description"
                      class="form-control"
                      placeholder="Enter task details">{{ $task->description }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Priority</label>
                <select name="priority" class="form-select">
                    <option value="Low" {{ $task->priority == 'Low' ? 'selected' : '' }}>🟢 Low</option>
                    <option value="Medium" {{ $task->priority == 'Medium' ? 'selected' : '' }}>🟡 Medium</option>
                    <option value="High" {{ $task->priority == 'High' ? 'selected' : '' }}>🔴 High</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="Pending" {{ $task->status == 'Pending' ? 'selected' : '' }}>⏳ Pending</option>
                    <option value="Completed" {{ $task->status == 'Completed' ? 'selected' : '' }}>✅ Completed</option>
                </select>
            </div>
        </div>

        <div class="btn-group-custom">

            <button type="submit" class="btn-premium btn-save">
                Update Task
            </button>

            <button type="button"
                    class="btn-premium btn-back"
                    onclick="history.back()">
                ← Back
            </button>

        </div>

    </form>

</div>

</body>
</html>