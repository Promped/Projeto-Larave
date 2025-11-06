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

    <div class="container mx-auto mt-6">
        <div class="flex flex-col md:flex-row gap-6">
            @auth
                <div class="md:w-64">
                    @include('partials.sidebar')
                </div>
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
        <script src="{{ asset('js/validation.js') }}"></script>
        <script>
            // Torna notificações com as classes bg-green-100 / bg-red-100 dismissible
            (function(){
                const selector = '.bg-green-100.border, .bg-red-100.border, .bg-green-100, .bg-red-100';
                const flashes = document.querySelectorAll(selector);
                flashes.forEach(el => {
                    // evitar adicionar duas vezes
                    if (el.dataset.dismissible) return;
                    el.dataset.dismissible = '1';

                    // wrapper para posicionamento relativo
                    el.style.position = 'relative';

                    const btn = document.createElement('button');
                    btn.type = 'button';
                    btn.innerHTML = '✕';
                    btn.setAttribute('aria-label','Fechar');
                    btn.className = 'flash-close absolute top-2 right-2 text-gray-600 hover:text-gray-800';
                    btn.style.background = 'transparent';
                    btn.style.border = 'none';
                    btn.style.fontSize = '1rem';
                    btn.style.cursor = 'pointer';

                    btn.addEventListener('click', function(){
                        el.style.transition = 'opacity 200ms ease';
                        el.style.opacity = '0';
                        setTimeout(()=> el.remove(), 220);
                    });

                    el.appendChild(btn);

                    // auto-dismiss after 6s
                    setTimeout(()=>{
                        if (!document.body.contains(el)) return;
                        el.style.transition = 'opacity 400ms ease';
                        el.style.opacity = '0';
                        setTimeout(()=> el.remove(), 420);
                    }, 6000);
                });
            })();
        </script>
</body>
</html>