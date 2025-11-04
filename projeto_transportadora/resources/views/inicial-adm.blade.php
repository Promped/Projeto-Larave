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
    </div>
</div>

<!-- Chart.js -->
<script>
    const ctx = document.getElementById('meuGrafico').getContext('2d');
    const meuGrafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
            datasets: [{
                label: 'Vendas (R$)',
                data: [1200, 1900, 3000, 2500, 2200],
                backgroundColor: 'rgba(54, 162, 235, 0.6)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
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