@extends('layouts.app')

@section('content')

<h2>Chamados</h2>

<a href="{{ route('chamados.create') }}">Novo Chamado</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Título</th>
    <th>Prioridade</th>
    <th>Status</th>
    <th>Técnico</th>
    <th>Categoria</th>
    <th>Ações</th>
</tr>

@foreach($chamados as $chamado)
<tr>
    <td>{{ $chamado->id }}</td>
    <td>{{ $chamado->titulo }}</td>
    <td>{{ $chamado->prioridade }}</td>
    <td>{{ $chamado->status }}</td>
    <td>{{ $chamado->tecnico->nome ?? '-' }}</td>
    <td>{{ $chamado->categoria->nome ?? '-' }}</td>
    <td>
        <a href="{{ route('chamados.show', $chamado->id) }}">Ver</a>
        <a href="{{ route('chamados.edit', $chamado->id) }}">Editar</a>

        <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </td>
</tr>
@endforeach

</table>

@endsection