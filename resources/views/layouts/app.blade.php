<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Mini Task Management</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Tailwind CDN (demo). For production, prefer Vite + Tailwind --}}
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { background: linear-gradient(135deg, #f6f9ff 0%, #fef6ff 100%); }
    .glass {
      background: rgba(255,255,255,0.7);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
      box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
    }
    .card { @apply glass rounded-2xl p-5 hover:-translate-y-0.5 transition-transform; }
    .btn { @apply inline-flex items-center gap-2 rounded-xl px-4 py-2 font-medium transition; }
    .btn-primary { @apply bg-indigo-600 text-white hover:bg-indigo-500 active:bg-indigo-700; }
    .btn-outline { @apply border border-slate-300 text-slate-700 hover:bg-slate-100; }
    .btn-danger { @apply bg-rose-600 text-white hover:bg-rose-500 active:bg-rose-700; }
    .badge { @apply inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold; }
    .badge-todo { @apply bg-amber-100 text-amber-700; }
    .badge-doing { @apply bg-sky-100 text-sky-700; }
    .badge-done { @apply bg-emerald-100 text-emerald-700; }
    .field { @apply flex flex-col gap-1; }
    .input, .select, .textarea {
      @apply w-full rounded-xl border border-slate-300 bg-white px-4 py-2 outline-none focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400;
    }
    .h1 { @apply text-2xl md:text-3xl font-semibold text-slate-800; }
    .muted { @apply text-slate-500; }
  </style>
</head>
<body class="min-h-screen">
  {{-- Topbar --}}
  <header class="sticky top-0 z-10 bg-white/70 backdrop-blur border-b border-slate-200">
    <div class="mx-auto max-w-6xl px-4 py-3 flex items-center justify-between">
      <a href="{{ route('tasks.index') }}" class="text-xl font-semibold text-slate-800">
        ✅ Mini Task Management
      </a>
      <nav class="flex items-center gap-2">
        <a class="btn btn-outline" href="{{ route('tasks.index') }}">Tasks</a>
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">+ New Task</a>
      </nav>
    </div>
  </header>

  {{-- Flash --}}
  @if (session('success'))
    <div class="mx-auto max-w-6xl px-4">
      <div class="mt-6 card border border-emerald-100">
        <div class="text-emerald-800">{{ session('success') }}</div>
      </div>
    </div>
  @endif

  {{-- Content --}}
  <main class="mx-auto max-w-6xl px-4 py-8">
    @yield('content')
  </main>

  <footer class="mt-10 pb-10 text-center text-sm muted">
    Built with Laravel • Tailwind cards
  </footer>
</body>
</html>
