@extends('layout')

@section('content')

<h1>Alterar dados</h1>
<form method="post" action="/funcaovisitante/{{ $funcaovisitante->id }}">
    @CSRF
    @METHOD('PUT')
    <div class="mb-3">
        <label for="descricao" class="form-label">Informe a descrição:</label>
        <input value="{{$funcaovisitante->descricao}}" type="text" id="descricao" name="descricao" class="form-control" required="">
    </div>
    <button type="submit" class="btn btn-primary">Enviar</button>
</form>

@endsection