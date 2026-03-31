@extends('layout') {{-- Ou um layout mais simples sem o menu lateral --}}

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-6">
            <h2 class="text-2xl font-bold text-blue-800 uppercase">LogisticsPro</h2>
            <p class="text-gray-500 text-sm">Comprovante de Saída Autorizada</p>
        </div>

        <form action="{{ route('ticket.gerar', $agendamento->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Informe seu CPF:</label>
                <input type="text" name="cpf" placeholder="000.000.000-00" 
                       class="w-full p-3 border rounded shadow-sm focus:ring-2 focus:ring-blue-500 outline-none" required>
            </div>
            
            <button type="submit" class="w-full bg-blue-800 text-white font-bold py-3 rounded hover:bg-black transition">
                VISUALIZAR TICKET
            </button>
        </form>
    </div>
</div>
@endsection