<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        // Start query builder
        $query = Task::query();
        // Search task by title
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        // Filter task by priority
        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }
           // Pagination - 5 tasks per page
        $tasks = $query->latest()->paginate(5) ->withQueryString(); // ensure pagination links include query parameters
        return view('tasks.index', compact('tasks')); // Send data to view
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required'
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title'=>'required'
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }

    public function complete(Task $task)
    {
        $task->update([
            'status' => 'Completed'
        ]);

        return back();
    }
}