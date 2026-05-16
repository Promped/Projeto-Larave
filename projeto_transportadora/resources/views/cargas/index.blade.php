@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho da Página --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">📦</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Cadastro de Materiais (Cargas)</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Gerencie os insumos e tipos de cargas que circulam nas balanças e pátio</p>
                </div>
            </div>
            <a href="{{ route('cargas.create') }}" 
               class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Novo Material
            </a>
        </div>

        {{-- Alerta de Sucesso --}}
        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Tabela de Dados --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Nome do Material / Tipo</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Unidade de Medida</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Descrição Técnica</th>
                        <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Operações</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                    @forelse($cargas as $carga)
                    <tr class="hover:bg-slate-50/80 transition-colors">
                        {{-- Nome --}}
                        <td class="px-6 py-4 whitespace-nowrap text-slate-800 font-black">
                            {{ $carga->tipo }}
                        </td>
                        
                        {{-- Unidade --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="bg-blue-50 border border-blue-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-blue-700 uppercase">
                                {{ $carga->unidade_medida }}
                            </span>
                        </td>
                        
                        {{-- Descrição --}}
                        <td class="px-6 py-4 text-slate-500 text-xs font-semibold italic max-w-xs truncate">
                            {{ $carga->descricao ?? 'Sem descrição técnica informada' }}
                        </td>

                        {{-- Ações --}}
                        <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                            <div class="flex justify-end items-center gap-2">
                                <a href="{{ route('cargas.edit', $carga->id) }}" 
                                   class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black uppercase hover:bg-blue-100 transition-all">
                                    Editar
                                </a>
                                <form action="{{ route('cargas.destroy', $carga->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            onclick="return confirm('Excluir este material permanentemente do sistema?')"
                                            class="px-4 py-2 bg-red-50 text-red-600 rounded-xl font-black uppercase hover:bg-red-100 transition-all">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <span class="text-4xl block mb-3">📦</span>
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhum material cadastrado na base de dados.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginação Integrada --}}
        <div class="mt-6">
            {{ $cargas->links() }}
        </div>
    </div>
</div>
@endsection