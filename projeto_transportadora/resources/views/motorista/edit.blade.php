@extends('layout')

@section('content')

<div class="bg-white shadow rounded p-6 max-w-2xl mx-auto">
    <h2 class="text-xl font-semibold mb-4">Alterar Motorista</h2>
    
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('motoristas.update', $motorista->id) }}" class="space-y-4">
        @csrf
        @method('PUT')
        
        <div>
            <label for="nome" class="block text-sm font-medium text-gray-700">Nome</label>
            <input value="{{ old('nome', $motorista->nome) }}" type="text" id="nome" name="nome" required 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('nome') border-red-500 @enderror" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                <input value="{{ old('cpf', $motorista->cpf) }}" type="text" id="cpf" name="cpf" required 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cpf') border-red-500 @enderror" />
            </div>
            <div>
                <label for="cnh" class="block text-sm font-medium text-gray-700">CNH</label>
                <input value="{{ old('cnh', $motorista->cnh) }}" type="text" id="cnh" name="cnh" 
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('cnh') border-red-500 @enderror" />
            </div>
        </div>

        <div>
            <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
            <input value="{{ old('telefone', $motorista->telefone) }}" type="text" id="telefone" name="telefone" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('telefone') border-red-500 @enderror" />
        </div>

        <div>
            <label for="transportadora_id" class="block text-sm font-medium text-gray-700">Transportadora</label>
            <select id="transportadora_id" name="transportadora_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="">-- Escolha --</option>
                @foreach(App\Models\Transportadora::all() as $t)
                    <option value="{{ $t->id }}" {{ old('transportadora_id', $motorista->transportadora_id) == $t->id ? 'selected' : '' }}>
                        {{ $t->razao_social ?? $t->descricao }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- CAMPO DE STATUS PARA DESBLOQUEAR O MOTORISTA -->
        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status de Acesso</label>
            <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm @error('status') border-red-500 @enderror" required>
                @php $s = old('status', $motorista->status); @endphp
                <option value="Ativo" {{ $s == 'Ativo' ? 'selected' : '' }}>Ativo (Liberado)</option>
                <option value="Bloqueado" {{ $s == 'Bloqueado' ? 'selected' : '' }}>Bloqueado (Negar Agendamento)</option>
                <option value="Inativo" {{ $s == 'Inativo' ? 'selected' : '' }}>Inativo</option>
            </select>
        </div>

        <div class="flex justify-end gap-2 pt-4">
            <a href="{{ route('motoristas.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">Cancelar</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Atualizar Motorista</button>
        </div>
    </form>
</div>

@endsection