@extends('layouts.app')

@section('content')
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
    <h1 class="h1">Tasks</h1>

    <form method="GET" action="{{ route('tasks.index') }}" class="flex gap-2">
      <input type="search" name="search" value="{{ $search }}" placeholder="Search by name..."
             class="input w-64" />
      <button type="submit" class="btn btn-outline">Search</button>
      @if($search)
        <a href="{{ route('tasks.index') }}" class="btn btn-outline">Reset</a>
      @endif
    </form>
  </div>

  @if($tasks->count())
    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
      @foreach($tasks as $task)
        <div class="card">
          <div class="flex items-start justify-between">
            <h3 class="text-lg font-semibold text-slate-800">{{ $task->name }}</h3>
            <span class="badge
              @if($task->status === 'todo') badge-todo
              @elseif($task->status === 'doing') badge-doing
              @else badge-done @endif">
              {{ strtoupper($task->status) }}
            </span>
          </div>

          @if($task->description)
            <p class="mt-2 text-slate-600 line-clamp-3">{{ $task->description }}</p>
          @else
            <p class="mt-2 text-slate-400 italic">No description</p>
          @endif

          <div class="mt-4 flex items-center justify-between text-sm">
            <div class="muted">
              Due:
              <span class="font-medium text-slate-700">
                {{ $task->due_date?->format('Y-m-d') ?? '—' }}
              </span>
            </div>
            <div class="muted">#{{ $task->id }}</div>
          </div>

          <div class="mt-5 flex items-center gap-2">
            <a href="{{ route('tasks.edit', $task) }}" class="btn btn-outline">Edit</a>
            <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                  onsubmit="return confirm('Delete this task?');">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </div>
        </div>
      @endforeach
    </div>

    <div class="mt-8">
      {{ $tasks->links() }}
    </div>
  @else
    <div class="card">
      <p class="text-slate-600">No tasks found.</p>
      <a href="{{ route('tasks.create') }}" class="btn btn-primary mt-4">Create your first task</a>
    </div>
  @endif
@endsection
