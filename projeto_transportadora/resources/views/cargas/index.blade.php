<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Materiais - Sistema Logístico</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <header class="bg-blue-600 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold italic">Gerenciamento 🚚</h1>
        <div class="flex items-center gap-4">
            <span>Olá, Admin</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 px-4 py-1 rounded hover:bg-red-600">Sair</button>
            </form>
        </div>
    </header>

    <div class="flex">
        <aside class="w-64 min-h-screen bg-white shadow-md">
            @include('partials.sidebar')
        </aside>

        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-800 border-l-4 border-blue-600 pl-3">F_B03: Cadastro de Materiais (Cargas)</h2>
                    <a href="{{ route('cargas.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 font-bold shadow">Novo Material</a>
                </div>

                @if (session('success'))
                    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded border border-green-200">{{ session('success') }}</div>
                @endif

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Nome / Tipo</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Unidade</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase">Descrição</th>
                                <th class="px-4 py-2 text-right text-xs font-bold text-gray-500 uppercase">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($cargas as $carga)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 text-sm font-bold text-gray-900">{{ $carga->tipo }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-600">
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs uppercase font-bold">{{ $carga->unidade_medida }}</span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 italic">{{ $carga->descricao ?? 'Sem descrição' }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <a href="{{ route('cargas.edit', $carga->id) }}" class="text-blue-600 hover:underline font-bold mr-3">Editar</a>
                                        <form action="{{ route('cargas.destroy', $carga->id) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 font-bold" onclick="return confirm('Excluir este material?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-6 text-gray-500">Nenhum material cadastrado.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-4">{{ $cargas->links() }}</div>
            </div>
        </main>
    </div>
</body>
</html>