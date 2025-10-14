<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Meu App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-xl font-bold">Meu App</a>
            <div>
                @auth
                    <span class="mr-4">Olá, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded">
                            Sair
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
                    <a href="{{ route('register') }}" class="bg-green-500 hover:bg-green-600 px-4 py-2 rounded">
                        Registrar
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto mt-8">
        @yield('content')
    </main>
</body>
</html>