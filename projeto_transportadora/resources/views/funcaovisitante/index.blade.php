@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho da Seção --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Parâmetros de Visitantes</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Gerenciamento de funções, triagem, níveis de acesso e controle de períodos de portaria</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('funcaovisitantes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider flex items-center">
                    <span class="mr-1.5 text-sm font-normal">+</span> Nova Função
                </a>
            </div>
        </div>

        {{-- Toast de Feedback Operacional --}}
        @if(session('sucesso'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wide mb-6 flex items-center gap-2">
                <span>✅</span> {{ session('sucesso') }}
            </div>
        @endif

        {{-- Grid / Tabela de Dados --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400 w-20">ID</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Classificação / Descrição</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Empresa Vinculada</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Alocação / Função</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Período Autorizado</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400 w-44">Ações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-xs">
                    @forelse($funcaovisitante as $item)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        
                        {{-- ID Formatado --}}
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-400">
                            #{{ str_pad($item->id, 3, '0', STR_PAD_LEFT) }}
                        </td>

                        {{-- Descrição Comercial --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-slate-800 font-black text-sm uppercase tracking-tight">{{ $item->descricao }}</span>
                        </td>

                        {{-- Empresa --}}
                        <td class="px-6 py-4 whitespace-nowrap uppercase tracking-tight text-slate-600">
                            {{ $item->empresa ?? 'Não Especificada' }}
                        </td>

                        {{-- Função Interna --}}
                        <td class="px-6 py-4 whitespace-nowrap uppercase tracking-tight text-slate-600">
                            {{ $item->funcao ?? 'Visitante Geral' }}
                        </td>

                        {{-- Período Autorizado --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="bg-slate-100 text-slate-600 font-black px-2.5 py-1.5 rounded-xl border border-slate-200 text-[10px] tracking-wide uppercase">
                                ⏱ {{ $item->periodo ?? 'Integral' }}
                            </span>
                        </td>

                        {{-- Ações Técnicas --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <div class="flex justify-center items-center gap-4">
                                <a href="{{ route('funcaovisitantes.edit', $item->id) }}" class="text-blue-600 hover:text-blue-800 font-black text-[10px] uppercase tracking-wider transition-colors">
                                    Editar
                                </a>
                                <a href="{{ route('funcaovisitantes.show', $item->id) }}" class="text-rose-500 hover:text-rose-700 font-black text-[10px] uppercase tracking-wider transition-colors">
                                    Excluir
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">🛂</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhuma parametrização de visitantes cadastrada no sistema.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection