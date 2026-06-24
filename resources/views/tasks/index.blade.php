<!DOCTYPE html>
<html>
<head>
<title>Tasks</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body {
    background: linear-gradient(135deg, #eef2ff, #f8fafc);
    font-family: 'Segoe UI', sans-serif;
}

/* Navbar */
.premium-navbar {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    padding: 14px 0;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
}

.premium-navbar .navbar-brand {
    color: #fff;
    font-size: 1.4rem;
    font-weight: 700;
}

/* Container Card */
.main-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    padding: 25px;
}

/* Table */
.table {
    border-radius: 12px;
    overflow: hidden;
}

.table thead {
    background: #1e293b;
    color: #fff;
}

.table tbody tr:hover {
    background: #f1f5f9;
    transition: 0.2s;
}

/* Buttons */
.btn-modern {
    border-radius: 10px;
    font-weight: 600;
    padding: 6px 12px;
}

/* Add Task Button */
.add-btn {
    background: linear-gradient(135deg, #10b981, #059669);
    color: #fff;
    border: none;
}

.add-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(16,185,129,0.3);
}

/* Filters */
.filter-box {
    background: #f8fafc;
    padding: 15px;
    border-radius: 12px;
    border: 1px solid #e2e8f0;
}
</style>

</head>
<body>

<!-- NAVBAR -->
<nav class="navbar premium-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">
            ✅ Task Management System
        </a>
    </div>
</nav>

<div class="container mt-4">

    <!-- ALERT -->
    <div class="alert alert-primary shadow-sm">
        <strong>Total Tasks:</strong> {{ $tasks->total() }}
    </div>

    <div class="main-card">

        <!-- FILTERS -->
        <form method="GET" action="{{ route('tasks.index') }}" class="row g-2 filter-box mb-3">

            <div class="col-md-5">
                <input type="text"
                       name="search"
                       value="{{ request('search') }}"
                       class="form-control"
                       placeholder="Search tasks...">
            </div>

            <div class="col-md-3">
                <select name="priority" class="form-select">
                    <option value="">All Priority</option>
                    <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
                    <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
                    <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
                </select>
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary w-100 btn-modern">Search</button>
            </div>

            <div class="col-md-2">
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary w-100 btn-modern">Clear</a>
            </div>

        </form>

        <!-- ADD BUTTON -->
        <a href="{{ route('tasks.create') }}" class="btn add-btn mb-3 btn-modern">
            + Add Task
        </a>

        <!-- TABLE -->
        <div class="table-responsive">
        <table class="table table-bordered align-middle">

            <thead>
                <tr>
                    <th>Title</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>

            @foreach($tasks as $task)
            <tr>
                <td>
                    <span
                        data-bs-toggle="tooltip"
                        data-bs-placement="top"
                        title="{{ $task->description ?: 'No description available' }}">
                        {{ $task->title }}
                    </span>
                </td>

                <td>
                    @if($task->priority == 'High')
                        <span class="badge bg-danger">High</span>
                    @elseif($task->priority == 'Medium')
                        <span class="badge bg-warning text-dark">Medium</span>
                    @else
                        <span class="badge bg-success">Low</span>
                    @endif
                </td>

                <td>
                    @if($task->status == 'Completed')
                        <span class="badge bg-success">Completed</span>
                    @else
                        <span class="badge bg-secondary">Pending</span>
                    @endif
                </td>

                <td class="d-flex gap-1">

                    <a href="{{ route('tasks.edit',$task->id) }}"
                       class="btn btn-sm btn-warning btn-modern">
                        Edit
                    </a>

                    <form action="{{ route('tasks.complete',$task->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="btn btn-sm btn-success btn-modern">
                            Done
                        </button>
                    </form>

                    <form action="{{ route('tasks.destroy',$task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger btn-modern">
                            Delete
                        </button>
                    </form>

                </td>
            </tr>
            @endforeach

            </tbody>

        </table>
        </div>

        <!-- PAGINATION -->
        <div class="mt-3 d-flex justify-content-center">
            {{ $tasks->links('pagination::bootstrap-5') }}
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );

    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
</body>
</html>