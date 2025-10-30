@extends('layout')

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h3>Detalhes do Veículo</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-3">Placa</dt>
                <dd class="col-sm-9">{{ $veiculo->placa }}</dd>

                <dt class="col-sm-3">Tipo</dt>
                <dd class="col-sm-9">{{ $veiculo->tipo }}</dd>

                <dt class="col-sm-3">Modelo</dt>
                <dd class="col-sm-9">{{ $veiculo->modelo }}</dd>

                <dt class="col-sm-3">Transportadora</dt>
                <dd class="col-sm-9">{{ $veiculo->transportadora->razao_social ?? $veiculo->transportadora->nome ?? 'N/A' }}</dd>

                <dt class="col-sm-3">Status</dt>
                <dd class="col-sm-9">{{ ucfirst($veiculo->status_acesso) }}</dd>
            </dl>

            <a href="{{ route('veiculos.index') }}" class="btn btn-secondary">Voltar</a>
            <a href="{{ route('veiculos.edit', $veiculo->id) }}" class="btn btn-primary">Editar</a>
        </div>
    </div>
</div>
@endsection