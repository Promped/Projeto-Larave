@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">🪪</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Motoristas Credenciados</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Controle de portaria, status de acesso e vinculo de frotas</p>
                </div>
            </div>
            <a href="{{ route('motoristas.create') }}" 
               class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Novo Motorista
            </a>
        </div>

        @if(session('sucesso'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('sucesso') }}
            </div>
        @endif
        
        @if(session('erro'))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-2xl text-red-800 font-bold text-xs uppercase tracking-wider">
                ⚠️ {{ session('erro') }}
            </div>
        @endif

        @if($motoristas->isEmpty())
            <div class="text-center py-16 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <span class="text-5xl block mb-4">🚛</span>
                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Nenhum motorista cadastrado no sistema pátio.</p>
            </div>
        @else
            <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-900 text-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">ID</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Motorista</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Documentação</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Empresa / Transportadora</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Portaria (Status)</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                        @foreach($motoristas as $motorista)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400 font-black">#{{ str_pad($motorista->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-extrabold text-slate-800 text-base">{{ $motorista->nome }}</div>
                                <div class="text-xs text-slate-400 font-medium mt-0.5">📞 {{ $motorista->telefone }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs space-y-1">
                                <div><span class="text-slate-400 font-black uppercase">CPF:</span> <span class="text-slate-600 font-extrabold">{{ $motorista->cpf }}</span></div>
                                <div><span class="text-slate-400 font-black uppercase">CNH:</span> <span class="text-slate-600 font-extrabold">{{ $motorista->cnh }}</span></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-slate-800 font-extrabold block max-w-xs truncate">
                                    🏢 {{ $motorista->transportadora ? $motorista->transportadora->razao_social : 'Agenciamento Autônomo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if(($motorista->status ?? 'Ativo') == 'Ativo')
                                    <span class="bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-emerald-700 uppercase">Liberado</span>
                                @elseif($motorista->status == 'Bloqueado')
                                    <span class="bg-red-50 border border-red-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-red-700 uppercase">Bloqueado</span>
                                @else
                                    <span class="bg-slate-100 border border-slate-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-slate-500 uppercase">Inativo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('motoristas.edit', $motorista->id) }}" 
                                       class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black uppercase hover:bg-blue-100 transition-all">
                                        Editar
                                    </a>
                                    <a href="{{ route('motoristas.show', $motorista->id) }}" 
                                       class="px-4 py-2 bg-red-50 text-red-600 rounded-xl font-black uppercase hover:bg-red-100 transition-all">
                                        Excluir
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection