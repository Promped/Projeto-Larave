<aside class="w-full md:w-64 bg-white shadow-md">
    <div class="p-4">
        <h3 class="text-lg font-bold mb-4">Menu</h3>
        <nav class="flex flex-col gap-2">
            <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-100 font-semibold text-blue-700">Meu Painel</a>
            <a href="{{ url('inicial-adm') }}" class="px-3 py-2 rounded hover:bg-gray-100 text-blue-600">Dashboard</a>
            <a href="{{ route('veiculos.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Veículos</a>
            <a href="{{ route('motoristas.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Motoristas</a>
            <a href="{{ route('transportadoras.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Transportadoras</a>
            <a href="{{ route('cargas.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Cargas</a>
            <a href="{{ route('areaspatio.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Áreas do Pátio</a>
            <a href="{{ route('funcaovisitantes.index') }}" class="px-3 py-2 rounded hover:bg-gray-100">Funções Visitante</a>
        </nav>
    </div>
</aside>