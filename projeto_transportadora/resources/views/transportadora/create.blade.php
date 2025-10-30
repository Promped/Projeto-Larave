@extends('layout')

@section('content')
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-6">Nova Transportadora</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('transportadoras.store') }}">
        @csrf

        <div class="mb-4">
            <label for="razao_social" class="block text-gray-700 text-sm font-bold mb-2">Razão Social</label>
            <input type="text" id="razao_social" name="razao_social" 
                   class="w-full px-3 py-2 border rounded-lg @error('razao_social') border-red-500 @enderror"
                   value="{{ old('razao_social') }}" required>
            @error('razao_social')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="cnpj" class="block text-gray-700 text-sm font-bold mb-2">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" 
                   class="w-full px-3 py-2 border rounded-lg @error('cnpj') border-red-500 @enderror"
                   value="{{ old('cnpj') }}" required>
            @error('cnpj')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="endereco" class="block text-gray-700 text-sm font-bold mb-2">Endereço</label>
            <input type="text" id="endereco" name="endereco" 
                   class="w-full px-3 py-2 border rounded-lg @error('endereco') border-red-500 @enderror"
                   value="{{ old('endereco') }}" required>
            @error('endereco')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="telefone" class="block text-gray-700 text-sm font-bold mb-2">Telefone</label>
            <input type="text" id="telefone" name="telefone" 
                   class="w-full px-3 py-2 border rounded-lg @error('telefone') border-red-500 @enderror"
                   value="{{ old('telefone') }}" required>
            @error('telefone')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
            <input type="email" id="email" name="email" 
                   class="w-full px-3 py-2 border rounded-lg @error('email') border-red-500 @enderror"
                   value="{{ old('email') }}" required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Cadastrar Transportadora
            </button>
        </div>
    </form>
</div>
@endsection