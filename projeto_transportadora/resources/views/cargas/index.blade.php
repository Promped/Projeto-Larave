@extends('layout') {{-- Ajustado para o nome real do seu arquivo --}}

@section('title', 'Cadastro de Materiais')

@section('content')
<div class="p-8 bg-slate-50 min-h-screen">
    {{-- CABEÇALHO DA PÁGINA --}}
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h2 class="text-2xl font-black text-slate-800 tracking-tighter flex items-center gap-2 italic">
                <span class="text-[#0046AD]">F_B03:</span> Cadastro de Materiais (Cargas)
            </h2>
            <p class="text-slate-500 text-sm font-medium">Gerencie os tipos de materiais que circulam no pátio.</p>
        </div>

        {{-- BOTÃO NOVO MATERIAL - PADRÃO VERDE SUZANO --}}
        <a href="{{ route('cargas.create') }}" class="bg-[#00A859] hover:bg-[#008F4C] text-white px-6 py-3 rounded-xl transition-all font-bold text-sm flex items-center gap-2 shadow-lg shadow-[#00A859]/20 group">
            <span class="text-lg group-hover:rotate-90 transition-transform duration-300">➕</span> Novo Material
        </a>
    </div>

    {{-- ALERTAS DE SUCESSO --}}
    @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-[#00A859] text-green-700 rounded-r-xl shadow-sm font-bold flex items-center">
            <span class="mr-3 text-xl">✅</span> {{ session('success') }}
        </div>
    @endif

    {{-- TABELA DE CARGAS --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-200">
                    <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Nome / Tipo</th>
                    <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-center">Unidade</th>
                    <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest">Descrição</th>
                    <th class="px-6 py-4 text-[11px] font-black text-slate-400 uppercase tracking-widest text-right">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($cargas as $carga)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-6 py-4 font-bold text-slate-700">{{ $carga->tipo }}</td>
                        <td class="px-6 py-4 text-center">
                            <span class="bg-blue-50 text-[#0046AD] text-[10px] font-black px-2 py-1 rounded-md uppercase border border-blue-100">
                                {{ $carga->unidade_medida }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-sm italic">{{ $carga->descricao ?? 'Sem descrição' }}</td>
                        <td class="px-6 py-4 text-right space-x-3">
                            <a href="{{ route('cargas.edit', $carga->id) }}" class="text-[#0046AD] hover:text-blue-800 font-bold text-sm">Editar</a>
                            
                            <form action="{{ route('cargas.destroy', $carga->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-bold text-sm" onclick="return confirm('Excluir este material?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">
                            Nenhum material cadastrado no sistema.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINAÇÃO --}}
    <div class="mt-6">
        {{ $cargas->links() }}
    </div>
</div>
@endsection