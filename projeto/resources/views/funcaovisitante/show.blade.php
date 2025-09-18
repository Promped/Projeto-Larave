@extends('layout')

@section('conteudo')

<h1>Consultar Dados</h1>
<form method="post" action="/funcaovisitante/{{ $funcaovisitante->id }}">
    @CSRF
    @METHOD('DELETE')
    <div class="mb-3">
        <label for="descricao" class="form-label">Informe a descrição:</label>
        <input value="{{$funcaovisitante->descricao}}" type="text" id="descricao" name="descricao" class="form-control" disabled>
    </div>
    <p>Deseja excluir esse registro?</p>
    <button type="submit" class="btn btn-danger">Sim</button>
    <a href="#" class="btn btn-secondary" onClick="history.back()">
        Não
    </a>
</form>

@endsection