@extends('layout')

@section('content')
<div class="flex-1 p-8 bg-slate-50 min-h-screen">
    <div class="bg-white shadow-xl rounded-3xl p-8 max-w-6xl mx-auto border-t-8 border-blue-600">
        
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
            <div class="flex items-center gap-4">
                <div class="bg-blue-50 p-3 rounded-2xl text-2xl text-blue-600 shadow-sm">🚛</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-800 uppercase tracking-tighter">Frota de Veículos</h2>
                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wide">Gerenciamento de frotas, placas mercosul e triagem de segurança</p>
                </div>
            </div>
            <a href="{{ route('veiculos.create') }}" 
               class="px-6 py-4 bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase rounded-2xl shadow-lg shadow-emerald-100 transition-all active:scale-95 flex items-center gap-2">
                <span>+</span> Novo Veículo
            </a>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl text-emerald-800 font-bold text-xs uppercase tracking-wider">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if($veiculos->isEmpty())
            <div class="text-center py-16 bg-slate-50 rounded-3xl border-2 border-dashed border-slate-200">
                <span class="text-5xl block mb-4">🛞</span>
                <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Nenhum veículo registrado na base logística.</p>
            </div>
        @else
            <div class="overflow-hidden border border-slate-100 rounded-3xl shadow-inner bg-slate-50/50">
                <table class="min-w-full divide-y divide-slate-100">
                    <thead class="bg-slate-900 text-slate-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Placa Identificadora</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Tipo de Frota</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Modelo / Marca</th>
                            <th class="px-6 py-4 text-left text-[10px] font-black uppercase tracking-widest text-slate-400">Transportadora Associada</th>
                            <th class="px-6 py-4 text-center text-[10px] font-black uppercase tracking-widest text-slate-400">Status Pátio</th>
                            <th class="px-6 py-4 text-right text-[10px] font-black uppercase tracking-widest text-slate-400">Operações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-100 font-bold text-slate-700 text-sm">
                        @foreach ($veiculos as $veiculo)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="bg-slate-100 text-slate-800 font-black px-3 py-1.5 rounded-lg border border-slate-300 text-sm tracking-wider font-mono shadow-sm">
                                    {{ strtoupper($veiculo->placa) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-600 font-extrabold text-xs uppercase">{{ $veiculo->tipo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-slate-800 font-black">{{ $veiculo->modelo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-slate-500 font-extrabold block max-w-xs truncate">
                                    🏢 {{ $veiculo->transportadora->razao_social ?? 'Autônomo / Terceirizado' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if(strtolower($veiculo->status_acesso) === 'ativo')
                                    <span class="bg-emerald-50 border border-emerald-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-emerald-700 uppercase">Liberado</span>
                                @elseif(strtolower($veiculo->status_acesso) === 'bloqueado')
                                    <span class="bg-red-50 border border-red-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-red-700 uppercase">Bloqueado</span>
                                @else
                                    <span class="bg-amber-50 border border-amber-200 px-3 py-1.5 rounded-xl text-[10px] font-black tracking-widest text-amber-700 uppercase">Inativo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-xs">
                                <div class="flex justify-end items-center gap-2">
                                    <a href="{{ route('veiculos.show', $veiculo->id) }}" 
                                       class="px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-black uppercase hover:bg-slate-200 transition-all">
                                        Ver
                                    </a>
                                    <a href="{{ route('veiculos.edit', $veiculo->id) }}" 
                                       class="px-4 py-2 bg-blue-50 text-blue-600 rounded-xl font-black uppercase hover:bg-blue-100 transition-all">
                                        Editar
                                    </a>
                                    <form action="{{ route('veiculos.destroy', $veiculo->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Tem certeza que deseja excluir este veículo?')"
                                                class="px-4 py-2 bg-red-50 text-red-600 rounded-xl font-black uppercase hover:bg-red-100 transition-all">
                                            Excluir
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $veiculos->links() }}
            </div>
        @endif
    </div>
</div>
@endsection