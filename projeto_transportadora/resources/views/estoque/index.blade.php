@extends('layout')

@section('content')
<div class="container mx-auto p-6">
    {{-- Cabeçalho com Botão de Cadastro --}}
    <div class="flex justify-between items-center mb-6 border-b-2 border-green-200 pb-4">
        <div>
            <h2 class="text-2xl font-bold text-green-800">📦 F_F08: Controle de Estoque Central</h2>
            <p class="text-sm text-gray-500">Monitoramento em Tempo Real (Integrado ao F_B07)</p>
        </div>
        
        <div class="flex items-center gap-4">
            <a href="{{ route('estoque.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-bold shadow-md transition-all flex items-center">
                <span class="mr-2">+</span> Novo Insumo
            </a>
            <span class="text-xs bg-green-100 text-green-700 px-3 py-1 rounded-full font-medium italic">
                Sincronizado com Pátio
            </span>
        </div>
    </div>

    {{-- Tabela de Insumos --}}
    <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
        <table class="min-w-full leading-normal">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-bold uppercase tracking-wider">Insumo</th>
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-bold uppercase tracking-wider">Local (F_B07)</th>
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-bold uppercase tracking-wider">Ocupação / Saldo</th>
                    <th class="px-5 py-3 border-b-2 text-left text-xs font-bold uppercase tracking-wider">Status do Inventário</th>
                    <th class="px-5 py-3 border-b-2 text-center text-xs font-bold uppercase tracking-wider">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($insumos as $insumo)
                <tr class="hover:bg-gray-50 transition-colors">
                    {{-- Nome e ID --}}
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <p class="text-gray-900 font-bold text-base">{{ $insumo->nome }}</p>
                        <p class="text-gray-500 text-xs">ID: #{{ str_pad($insumo->id, 4, '0', STR_PAD_LEFT) }}</p>
                    </td>

                    {{-- Local Dinâmico --}}
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <span class="px-3 py-1 rounded-full text-xs font-black bg-blue-50 text-blue-700 border border-blue-200">
                            📍 {{ $insumo->local_armazenagem }}
                        </span>
                    </td>

                    {{-- Barra de Progresso e Saldo --}}
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        <div class="flex flex-col">
                            <span class="text-gray-900 font-medium">
                                {{ number_format($insumo->quantidade_atual, 2, ',', '.') }} / {{ number_format($insumo->limite_maximo, 2, ',', '.') }} 
                                <span class="text-gray-400 text-xs font-normal">{{ $insumo->unidade_medida }}</span>
                            </span>
                            <div class="w-full bg-gray-200 rounded-full h-1.5 mt-2">
                                {{-- Lógica de cor da barra --}}
                                @php
                                    $porcentagem = ($insumo->limite_maximo > 0) ? ($insumo->quantidade_atual / $insumo->limite_maximo) * 100 : 0;
                                    $corBarra = 'bg-blue-500';
                                    if($insumo->quantidade_atual <= $insumo->quantidade_minima) $corBarra = 'bg-red-500';
                                    if($porcentagem >= 90) $corBarra = 'bg-orange-500';
                                @endphp
                                <div class="{{ $corBarra }} h-1.5 rounded-full shadow-inner transition-all duration-500" 
                                     style="width: {{ min($porcentagem, 100) }}%">
                                </div>
                            </div>
                        </div>
                    </td>

                    {{-- Status com Badges --}}
                    <td class="px-5 py-5 border-b border-gray-200 text-sm">
                        @if($insumo->quantidade_atual <= $insumo->quantidade_minima)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 animate-pulse border border-red-200">
                                <span class="mr-1">🚨</span> CRÍTICO: REPOR
                            </span>
                        @elseif($porcentagem >= 90)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700 border border-orange-200">
                                <span class="mr-1">🚫</span> PÁTIO LOTADO
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">
                                <span class="mr-1">✅</span> ESTOQUE NORMAL
                            </span>
                        @endif
                    </td>

                    {{-- Botões de Ação --}}
                    <td class="px-5 py-5 border-b border-gray-200 text-sm text-center">
                        <div class="flex justify-center items-center gap-3">
                            <a href="{{ route('estoque.edit', $insumo->id) }}" class="text-blue-600 hover:text-blue-800 font-bold transition-colors">
                                📝 Editar
                            </a>
                            <form action="{{ route('estoque.destroy', $insumo->id) }}" method="POST" onsubmit="return confirm('Deseja realmente remover este insumo?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold transition-colors">
                                    🗑️ Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-10 border-b border-gray-200 bg-white text-sm text-center">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl mb-2">📦</span>
                            <p class="text-gray-500 italic">Nenhum insumo cadastrado nas áreas do pátio.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection