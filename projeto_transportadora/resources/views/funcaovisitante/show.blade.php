@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen flex items-center justify-center">
    <div class="bg-white shadow-2xl rounded-3xl p-8 max-w-md w-full border-t-8 border-rose-500 text-center">
        
        {{-- Ícone Destrutivo de Alerta --}}
        <div class="w-16 h-16 bg-rose-50 border border-rose-100 text-rose-500 flex items-center justify-center rounded-2xl text-2xl mx-auto mb-4 animate-bounce">
            ⚠️
        </div>

        <h2 class="text-xl font-black text-slate-800 uppercase tracking-tighter mb-1">Remover Parametrização?</h2>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-wide mb-6">Esta ação revogará a lógica de triagem para novos visitantes desta categoria</p>

        {{-- Caixa de Detalhes Interna --}}
        <div class="bg-slate-50 border border-slate-100 p-4 rounded-2xl mb-6 text-left font-bold text-xs uppercase">
            <span class="text-slate-400 block tracking-wider text-[10px] font-black mb-1">Categoria Selecionada</span>
            <span class="text-slate-700 text-sm font-black tracking-tight">{{ $funcaovisitante->descricao }}</span>
        </div>

        {{-- Form de Confirmação Otimizado --}}
        <form method="POST" action="{{ route('funcaovisitantes.destroy', $funcaovisitante->id) }}">
            @csrf
            @method('DELETE')
            
            <p class="text-xs text-slate-500 font-bold uppercase tracking-wide mb-6">Confirma a exclusão definitiva deste registro?</p>

            <div class="grid grid-cols-2 gap-3">
                <a href="{{ route('funcaovisitantes.index') }}" class="px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-600 font-black text-xs uppercase rounded-xl transition-all tracking-wider text-center">
                    Não, Cancelar
                </a>
                <button type="submit" class="px-4 py-3 bg-rose-500 hover:bg-rose-600 text-white font-black text-xs uppercase rounded-xl shadow-lg shadow-rose-100 transition-all active:scale-95 tracking-wider">
                    Sim, Excluir
                </button>
            </div>
        </form>
    </div>
</div>
@endsection