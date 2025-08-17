@extends('layouts.app')

@section('content')
  <div class="max-w-3xl mx-auto">
    <div class="mb-6">
      <h1 class="h1">Create Task</h1>
      <p class="muted">Add a new task with status and optional due date.</p>
    </div>

    <form method="POST" action="{{ route('tasks.store') }}" class="card">
      @csrf

      <div class="grid gap-5">
        <div class="field">
          <label class="text-sm font-medium text-slate-700">Name</label>
          <input type="text" name="name" value="{{ old('name') }}" class="input" required>
          @error('name') <small class="text-rose-600">{{ $message }}</small> @enderror
        </div>

        <div class="field">
          <label class="text-sm font-medium text-slate-700">Description</label>
          <textarea name="description" rows="4" class="textarea">{{ old('description') }}</textarea>
          @error('description') <small class="text-rose-600">{{ $message }}</small> @enderror
        </div>

        <div class="grid sm:grid-cols-2 gap-5">
          <div class="field">
            <label class="text-sm font-medium text-slate-700">Status</label>
            <select name="status" class="select" required>
              @foreach (['todo'=>'To Do','doing'=>'Doing','done'=>'Done'] as $val => $label)
                <option value="{{ $val }}" @selected(old('status','todo')===$val)>{{ $label }}</option>
              @endforeach
            </select>
            @error('status') <small class="text-rose-600">{{ $message }}</small> @enderror
          </div>

          <div class="field">
            <label class="text-sm font-medium text-slate-700">Due Date</label>
            <input type="date" name="due_date" value="{{ old('due_date') }}" class="input">
            @error('due_date') <small class="text-rose-600">{{ $message }}</small> @enderror
          </div>
        </div>
      </div>

      <div class="mt-6 flex items-center gap-3">
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-outline">Cancel</a>
      </div>
    </form>
  </div>
@endsection
