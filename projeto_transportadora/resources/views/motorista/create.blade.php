@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Novo Motorista</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('motoristas.store') }}" class="space-y-4">
        @csrf
        
        <div>
            <label for="nome" class="block text-gray-700 text-sm font-bold mb-2">Nome</label>
            <input type="text" id="nome" name="nome" 
                   class="w-full px-3 py-2 border rounded-lg @error('nome') border-red-500 @enderror"
                   value="{{ old('nome') }}" required>
            @error('nome')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cpf" class="block text-gray-700 text-sm font-bold mb-2">CPF</label>
            <input type="text" id="cpf" name="cpf" 
                   class="w-full px-3 py-2 border rounded-lg @error('cpf') border-red-500 @enderror"
                   value="{{ old('cpf') }}" required>
            @error('cpf')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="cnh" class="block text-gray-700 text-sm font-bold mb-2">CNH</label>
            <input type="text" id="cnh" name="cnh" 
                   class="w-full px-3 py-2 border rounded-lg @error('cnh') border-red-500 @enderror"
                   value="{{ old('cnh') }}" required>
            @error('cnh')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="telefone" class="block text-gray-700 text-sm font-bold mb-2">Telefone</label>
            <input type="text" id="telefone" name="telefone" 
                   class="w-full px-3 py-2 border rounded-lg @error('telefone') border-red-500 @enderror"
                   value="{{ old('telefone') }}" required>
            @error('telefone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="transportadora_id" class="block text-gray-700 text-sm font-bold mb-2">Transportadora</label>
            <select id="transportadora_id" name="transportadora_id" 
                    class="w-full px-3 py-2 border rounded-lg @error('transportadora_id') border-red-500 @enderror">
                <option value="">-- Selecione uma transportadora --</option>
                @foreach(App\Models\Transportadora::all() as $transportadora)
                    <option value="{{ $transportadora->id }}" 
                            {{ old('transportadora_id') == $transportadora->id ? 'selected' : '' }}>
                        {{ $transportadora->razao_social }}
                    </option>
                @endforeach
            </select>
            @error('transportadora_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cadastrar Motorista
            </button>
        </div>
    </form>
</div>
@endsection