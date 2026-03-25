@extends('layout') {{-- Sempre usando 'layout' conforme sua estrutura --}}

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-6 text-orange-700">🛠️ F_F09: Ordem de Produção / Montagem</h2>

    <div class="bg-white p-6 rounded-lg shadow-md border-t-4 border-orange-500">
        <form action="{{ route('producao.baixar') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold">Selecione o Insumo:</label>
                    <select name="insumo_id" class="w-full border p-2 rounded">
                        @foreach($insumos as $insumo)
                            <option value="{{ $insumo->id }}">{{ $insumo->nome }} (Saldo: {{ $insumo->quantidade_atual }})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block font-bold">Quantidade a ser Usada:</label>
                    <input type="number" name="quantidade_usada" step="0.01" class="w-full border p-2 rounded" required>
                </div>
            </div>
            <button type="submit" class="mt-4 bg-orange-600 text-white px-6 py-2 rounded hover:bg-orange-700 font-bold">
                Finalizar Produção (Dar Baixa)
            </button>
        </form>
    </div>
</div>
@endsection