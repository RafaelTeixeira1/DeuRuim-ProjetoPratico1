@extends('layouts.app')

@section('content')

<h2>Categorias</h2>

<a href="{{ route('categorias.create') }}">Nova Categoria</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Nome</th>
    <th>SLA</th>
    <th>Ações</th>
</tr>

@foreach($categorias as $categoria)
<tr>
    <td>{{ $categoria->id }}</td>
    <td>{{ $categoria->nome }}</td>
    <td>{{ $categoria->sla_horas }}</td>
    <td>
        <a href="{{ route('categorias.show',$categoria->id) }}">Ver</a>
        <a href="{{ route('categorias.edit',$categoria->id) }}">Editar</a>

        <form action="{{ route('categorias.destroy',$categoria->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Excluir</button>
        </form>
    </td>
</tr>
@endforeach

</table>

@endsection