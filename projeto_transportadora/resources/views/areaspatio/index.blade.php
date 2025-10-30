@extends('layout')

@section('content')

<h2>Áreas patio</h2>
    @if(session('sucesso'))
        <p class="text-success">{{ session('sucesso') }}</p>
    @endif
    @if(session('erro'))
        <p class="text-danger">{{ session('erro') }}</p>
    @endif
    <a href="/areaspatio/create" class="btn btn-success mb-3">Novo Registro</a>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
            <th>ID</th>
            <th>Descrição</th>
            </tr>
        </thead>
        <tbody>
            @foreach($areaspatio as $c)
            <tr>
                <td>{{ $c->id }}</td>
                <td>{{ $c->descricao }}</td>
                <td class="d-flex gap-2">
                    <a href="/areaspatio/{{ $c->id }}/edit" class="btn btn-sm btn-warning">Editar</a>
                    <a href="/areaspatio/{{ $c->id }}" class="btn btn-sm btn-info">Consultar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>    

@endsection