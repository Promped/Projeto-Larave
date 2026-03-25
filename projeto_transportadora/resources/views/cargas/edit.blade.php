<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Material - Sistema Logístico</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-blue-600 text-white p-4 flex justify-between items-center shadow-md">
        <h1 class="text-xl font-bold italic">Gerenciamento 🚚</h1>
    </header>

    <div class="flex">
        <aside class="w-64 min-h-screen bg-white shadow-md">
            @include('partials.sidebar')
        </aside>

        <main class="flex-1 p-8">
            <div class="bg-white shadow rounded p-6 max-w-2xl mx-auto border-t-4 border-blue-600">
                <h2 class="text-xl font-bold mb-6 text-gray-800">📝 Editar Material: {{ $carga->tipo }}</h2>

                <form action="{{ route('cargas.update', $carga->id) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nome / Tipo</label>
                        <input type="text" name="tipo" value="{{ $carga->tipo }}" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Unidade de Medida</label>
                        <select name="unidade_medida" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">
                            <option value="ton" {{ $carga->unidade_medida == 'ton' ? 'selected' : '' }}>Toneladas (ton)</option>
                            <option value="kg" {{ $carga->unidade_medida == 'kg' ? 'selected' : '' }}>Quilos (kg)</option>
                            <option value="m3" {{ $carga->unidade_medida == 'm3' ? 'selected' : '' }}>Metros Cúbicos (m³)</option>
                            <option value="un" {{ $carga->unidade_medida == 'un' ? 'selected' : '' }}>Unidades (un)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descrição</label>
                        <textarea name="descricao" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm p-2 border">{{ $carga->descricao }}</textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-4 border-t">
                        <a href="{{ route('cargas.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Cancelar</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-md">Atualizar</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>