<div class="max-w-md mx-auto bg-white p-8 border-2 border-dashed border-gray-400" id="ticket">
    <h1 class="text-center font-bold text-xl">LogisticsPro - TICKET DE SAÍDA</h1>
    <hr class="my-4">
    <p><strong>Placa:</strong> {{ $mov->agendamento->veiculo->placa }}</p>
    <p><strong>Motorista:</strong> {{ $mov->agendamento->motorista->nome }}</p>
    <p><strong>Data/Hora:</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Fiscal Responsável:</strong> {{ auth()->user()->name }}</p>
    
    <div class="mt-6 p-4 bg-gray-100 text-center text-xs">
        ESTE DOCUMENTO COMPROVA A CONFERÊNCIA FÍSICA E DOCUMENTAL DO VEÍCULO.
    </div>

    <button onclick="window.print()" class="mt-4 w-full bg-blue-600 text-white py-2 no-print">
        Imprimir Comprovante
    </button>
</div>

<style>
    @media print {
        .no-print { display: none; }
    }
</style>