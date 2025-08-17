<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    // GET /tasks?search=foo
    public function index(Request $request)
    {
        $search = $request->query('search');

        $tasks = Task::query()
            ->when($search, fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->latest()
            ->paginate(9) // 3 x 3 grid
            ->withQueryString();

        return view('tasks.index', compact('tasks', 'search'));
    }

    // GET /tasks/create
    public function create()
    {
        return view('tasks.create');
    }

    // POST /tasks
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'status'      => ['required', Rule::in(['todo','doing','done'])],
            'due_date'    => ['nullable','date'],
        ]);

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    // GET /tasks/{task}/edit
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    // PUT /tasks/{task}
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name'        => ['required','string','max:255'],
            'description' => ['nullable','string'],
            'status'      => ['required', Rule::in(['todo','doing','done'])],
            'due_date'    => ['nullable','date'],
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    // DELETE /tasks/{task}
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted.');
    }
}
