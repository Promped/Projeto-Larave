@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        {{-- Cabeçalho da Seção --}}
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8 border-b border-slate-100 pb-6">
            <div>
                <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Controle de Credenciais</h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Gerenciamento de usuários, níveis de permissão (Master/Operador) e vinculação de empresas</p>
            </div>
            
            <div class="flex items-center gap-3">
                <a href="{{ route('usuarios.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl text-xs font-black uppercase shadow-lg shadow-blue-100 transition-all active:scale-95 tracking-wider flex items-center">
                    <span class="mr-1.5 text-sm font-normal">+</span> Novo Usuário
                </a>
            </div>
        </div>

        @if(session('sucesso'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3.5 rounded-xl font-bold text-xs uppercase tracking-wide mb-6">
                ✅ {{ session('sucesso') }}
            </div>
        @endif

        {{-- Tabela Corporativa --}}
        <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
            <table class="min-w-full divide-y divide-slate-100">
                <thead class="bg-slate-900 text-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Nome do Usuário</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">E-mail de Login</th>
                        <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Empresa Atribuída</th>
                        <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Nível de Acesso</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-xs">
                    @forelse($usuarios as $usuario)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        
                        {{-- Nome --}}
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-slate-800 font-black text-sm uppercase tracking-tight">{{ $usuario->name }}</span>
                        </td>

                        {{-- Email --}}
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-slate-500 text-xs">
                            {{ $usuario->email }}
                        </td>

                        {{-- Empresa --}}
                        <td class="px-6 py-4 whitespace-nowrap uppercase tracking-tight text-slate-600">
                            {{ $usuario->empresa ?? 'Não Vinculada' }}
                        </td>

                        {{-- Regra de Acesso com Badges Distintos --}}
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($usuario->role === 'master')
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-purple-50 border border-purple-200 text-purple-700 uppercase tracking-wider">
                                    ⚙️ Administrador Master
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-xl text-[10px] font-black bg-blue-50 border border-blue-200 text-blue-700 uppercase tracking-wider">
                                    🏢 Operador Local
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-16 text-center bg-slate-50 rounded-b-3xl">
                            <p class="text-xs font-black text-slate-400 uppercase tracking-widest">Nenhum usuário cadastrado no sistema.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection