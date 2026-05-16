@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-3xl mx-auto border-t-8 border-amber-500">
        
        {{-- Header integrado --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('funcaovisitantes.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Editar Parâmetros de Visitante</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Modificando o registro de acesso ID: <span class="text-slate-700 font-black font-mono">#{{ $funcaovisitante->id }}</span></p>
            </div>
        </div>

        {{-- Erros --}}
        @if ($errors->any())
            <div class="bg-rose-50 border border-rose-200 text-rose-800 p-4 rounded-xl mb-6 text-xs font-bold uppercase tracking-wide">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('funcaovisitantes.update', $funcaovisitante->id) }}" class="space-y-6">
            @csrf
            @method('PUT')
            
            {{-- Descrição --}}
            <div>
                <label for="descricao" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Descrição / Tipo de Identificação</label>
                <input id="descricao" name="descricao" value="{{ $funcaovisitante->descricao }}" type="text" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase" required>
            </div>

            {{-- Empresa --}}
            <div>
                <label for="empresa" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Empresa Solicitante</label>
                <input id="empresa" name="empresa" value="{{ $funcaovisitante->empresa }}" type="text" 
                    class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Função --}}
                <div>
                    <label for="funcao" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Atribuição / Cargo</label>
                    <input id="funcao" name="funcao" value="{{ $funcaovisitante->funcao }}" type="text" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
                </div>
                
                {{-- Período --}}
                <div>
                    <label for="periodo" class="block text-xs font-black text-slate-500 uppercase tracking-wider mb-2">Período de Acesso Permitido</label>
                    <input id="periodo" name="periodo" value="{{ $funcaovisitante->periodo }}" type="text" 
                        class="w-full px-4 py-3 border border-slate-200 rounded-xl bg-slate-50/50 font-bold text-slate-700 text-sm focus:border-blue-500 focus:bg-white focus:ring-1 focus:ring-blue-500 outline-none transition-all uppercase">
                </div>
            </div>

            {{-- Botões --}}
            <div class="flex justify-end gap-4 border-t border-slate-100 pt-6">
                <a href="{{ route('funcaovisitantes.index') }}" class="px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all text-center tracking-wider">
                    Cancelar Edição
                </a>
                <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-amber-100 transition-all active:scale-95 tracking-wider">
                    Atualizar Registro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection