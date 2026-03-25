<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('truck.png') }}">
    <title>@yield('title') - Sistema Logístico</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="container mx-auto px-6 h-16 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                <div class="bg-indigo-600 p-2 rounded-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path></svg>
                </div>
                <span class="text-xl font-bold tracking-tight text-slate-800">Logistics<span class="text-indigo-600">Pro</span></span>
            </a>

            <div class="flex items-center gap-4">
                @auth
                    <div class="hidden md:block text-right mr-2">
                        <p class="text-xs text-slate-500 font-medium uppercase tracking-wider">Usuário Autenticado</p>
                        <p class="text-sm font-bold text-slate-700">{{ Auth::user()->name }}</p>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-600 px-4 py-2 rounded-lg transition-all font-medium">
                            <span>Sair</span>
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-6 py-8">
        <div class="flex flex-col md:flex-row gap-8">
            @auth
                <aside class="md:w-72">
                    <div class="sticky top-24 bg-white rounded-2xl border border-slate-200 p-4 shadow-sm">
                        @include('partials.sidebar')
                    </div>
                </aside>
                <main class="flex-1">
                    @yield('content')
                </main>
            @else
                <main class="w-full">
                    @yield('content')
                </main>
            @endauth
        </div>
    </div>
</body>
</html>