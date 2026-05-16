@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-2xl mx-auto border-t-8 border-slate-800">
        
        {{-- Header --}}
        <div class="flex items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <a href="{{ route('usuarios.index') }}" class="p-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl transition-all active:scale-95 text-xs font-black uppercase tracking-wider">
                ⬅ Voltar
            </a>
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Perfil da Credencial</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Ficha cadastral de parametrização de segurança do usuário</p>
            </div>
        </div>

        {{-- Informações do Usuário --}}
        <div class="space-y-6">
            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-4">
                
                <div>
                    <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nome do Funcionário / Usuário</span>
                    <div class="text-base font-black text-slate-800 uppercase tracking-tight">{{ $usuario->name }}</div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-200/60">
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">E-mail (Login de Acesso)</span>
                        <div class="text-sm font-mono font-bold text-slate-600">{{ $usuario->email }}</div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Data de Criação do Perfil</span>
                        <div class="text-sm font-bold text-slate-600">{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y H:i') : '--/--/----' }}</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2 border-t border-slate-200/60">
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Nível de Permissão Corporativa</span>
                        <div>
                            @if($usuario->role === 'master')
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black bg-purple-100 text-purple-800 uppercase tracking-wider">
                                    ⚙️ MASTER CENTRAL
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-lg text-[10px] font-black bg-blue-100 text-blue-800 uppercase tracking-wider">
                                    🏢 OPERADOR LOCAL
                                </span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Empresa Atribuída</span>
                        <div class="text-sm font-black text-slate-700 uppercase tracking-tight">{{ $usuario->empresa ?? 'NENHUMA VINCULADA' }}</div>
                    </div>
                </div>

            </div>

            {{-- Informativo Técnico de Segurança --}}
            <div class="p-4 bg-blue-50/50 border border-blue-100 rounded-xl flex gap-3">
                <span class="text-lg">🛡️</span>
                <p class="text-[11px] font-bold text-blue-700/80 uppercase tracking-tight leading-relaxed">
                    Atenção: Por determinação das normas de segurança interna da plataforma, senhas criptografadas em hash não podem ser visualizadas por nenhum operador do sistema.
                </p>
            </div>
        </div>

    </div>
</div>
@endsection