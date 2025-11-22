@extends('layout')

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Conteúdo -->
<div class="container my-5">
    <div class="text-center mb-4">
        <h1 class="fw-bold">Dashboard</h1>
        <p class="text-muted">Visualização de dados</p>
    </div>

    <div class="card p-4">
        <canvas id="meuGrafico" height="120"></canvas>
        <div id="infoSelecionado" class="mt-4 text-center" style="display:none;">
            <div id="mesSelecionado" class="font-bold text-lg"></div>
            <div id="valorSelecionado" class="text-blue-700 text-xl"></div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    const meses = ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'];
    const valores = [1200, 1900, 3000, 2500, 2200];
    let barraSelecionada = null;

    const meuGrafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Vendas (R$)',
                data: valores,
                backgroundColor: meses.map((_, i) => 'rgba(54, 162, 235, 0.6)'),
                borderColor: meses.map((_, i) => 'rgba(54, 162, 235, 1)'),
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            onClick: (evt, elements) => {
                if (elements.length > 0) {
                    const idx = elements[0].index;
                    barraSelecionada = idx;
                    // Destacar barra selecionada
                    meuGrafico.data.datasets[0].backgroundColor = meses.map((_, i) => i === idx ? 'rgba(54, 162, 235, 1)' : 'rgba(54, 162, 235, 0.6)');
                    meuGrafico.update();
                    // Mostrar info
                    document.getElementById('infoSelecionado').style.display = 'block';
                    document.getElementById('mesSelecionado').innerText = meses[idx];
                    document.getElementById('valorSelecionado').innerText = `Vendas: R$ ${valores[idx].toLocaleString('pt-BR')}`;
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Vendas Mensais'
                }
            }
        }
    });
</script>
@endsection