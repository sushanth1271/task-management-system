<!DOCTYPE html>
<html>
<head>
<title>Tasks</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg premium-navbar">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">
            <i class="bi bi-check2-square me-2"></i>
            Task Management System
        </a>
    </div>
</nav>

<style>
.premium-navbar {
    background: linear-gradient(135deg, #0f172a, #1e293b);
    padding: 14px 0;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25);
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.premium-navbar .navbar-brand {
    color: #fff;
    font-size: 1.4rem;
    letter-spacing: 0.5px;
    font-weight: 700;
    transition: all 0.3s ease;
}

.premium-navbar .navbar-brand:hover {
    color: #60a5fa;
    transform: translateY(-1px);
}

.premium-navbar i {
    color: #38bdf8;
}
</style>  
<div class="alert alert-info">

    Total Tasks Found:
    {{ $tasks->total() }}

</div>
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
<!-- Search + Priority Filter Form -->
<form method="GET"
      action="{{ route('tasks.index') }}"
      class="row mb-3">

    <!-- Search Box -->
    <div class="col-md-4">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               class="form-control"
               placeholder="Search Tasks">

    </div>

    <!-- Priority Filter Dropdown -->
    <div class="col-md-3">

        <select name="priority"
                class="form-control">

            <option value="">All Priorities</option>

            <option value="Low"
                {{ request('priority') == 'Low' ? 'selected' : '' }}>
                Low
            </option>

            <option value="Medium"
                {{ request('priority') == 'Medium' ? 'selected' : '' }}>
                Medium
            </option>

            <option value="High"
                {{ request('priority') == 'High' ? 'selected' : '' }}>
                High
            </option>

        </select>

    </div>

    <!-- Search Button -->
    <div class="col-md-2">

        <button type="submit"
                class="btn btn-primary">
            Search
        </button>

    </div>

    <!-- Clear Filter Button -->
    <div class="col-md-2">

        <a href="{{ route('tasks.index') }}"
           class="btn btn-secondary">
            Clear
        </a>

    </div>

</form>
<a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">
    + Add Task
</a>

<table class="table table-hover table-bordered align-middle">

<tr>
<th>Title</th>
<th>Priority</th>
<th>Status</th>
<th>Action</th>
</tr>

@foreach($tasks as $task)

<tr>
<td>{{ $task->title }}</td>
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

<td>

<a href="{{ route('tasks.edit',$task->id) }}"
   class="btn btn-sm btn-warning">
    Edit
</a>

<form action="{{ route('tasks.complete',$task->id) }}"
      method="POST"
      style="display:inline;">
    @csrf
    @method('PATCH')

    <button class="btn btn-sm btn-success">
        Done
    </button>
</form>

<form action="{{ route('tasks.destroy',$task->id) }}"
      method="POST"
      style="display:inline;">
    @csrf
    @method('DELETE')

    <button class="btn btn-sm btn-danger">
        Delete
    </button>
</form>

</td>
</tr>

@endforeach

</table>
<div class="mt-3 d-flex justify-content-center">
    {{ $tasks->links('pagination::bootstrap-5') }}
</div>
     </div>
        </div>   
</div>

</body>
</html>