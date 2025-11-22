<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('truck.png') }}">
    <title>@yield('title') - Meu App</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="#" class="flex items-center gap-2 text-xl font-bold">
                <span> Gerenciamento </span>
                <svg width="28px" height="28px" viewBox="0 0 1024 1024" class="icon"  version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M173.248 113.344H860.16v736.832H173.248z" fill="#D3552F" />
                    <path d="M173.248 113.344H860.16v132.672H173.248z" fill="#9D2524" />
                    <path d="M212.48 308.864h608.384v230.72H212.48z" fill="#4E6874" />
                    <path d="M215.168 850.112h99.776v73.856H215.168zM721.152 850.112h99.776v73.856h-99.776zM860.16 617.28h39.296v44.288h-39.296z" fill="#425760" /><path d="M889.024 489.28h76.096v183.552h-76.096z" fill="#D3552F" />
                    <path d="M133.888 617.28h39.36v44.288h-39.36z" fill="#425760" /><path d="M68.288 489.28h76.032v183.552H68.288z" fill="#D3552F" /><path d="M368.768 589.44h304.192v207.104H368.768z" fill="#4E6874" />
                    <path d="M368.768 636.032h304.192v36.288H368.768zM368.768 715.52h304.192v36.352H368.768z" fill="#6D858E" /><path d="M238.72 661.568h68.352v68.352H238.72zM736.768 661.568h68.352v68.352h-68.352z" fill="#FFFFFF" /></svg>
            </a>
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
            // Torna apenas alertas (mensagens flash) dismissíveis, não os cards do dashboard
            (function(){
                // Seleciona apenas elementos de alerta, por exemplo, que tenham a classe 'alert' ou 'flash-message'
                const selector = '.alert, .flash-message';
                const flashes = document.querySelectorAll(selector);
                flashes.forEach(el => {
                    if (el.dataset.dismissible) return;
                    el.dataset.dismissible = '1';
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