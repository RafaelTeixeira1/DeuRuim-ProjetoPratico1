@extends('layouts.app')

@section('content')

<h2>Técnicos</h2>

<a href="{{ route('tecnicos.create') }}">Novo Técnico</a>

<table border="1">
<tr>
<th>ID</th>
<th>Nome</th>
<th>Email</th>
<th>Especialidade</th>
<th>Ações</th>
</tr>

@foreach($tecnicos as $tecnico)
<tr>
<td>{{ $tecnico->id }}</td>
<td>{{ $tecnico->nome }}</td>
<td>{{ $tecnico->email }}</td>
<td>{{ $tecnico->especialidade }}</td>
<td>

<a href="{{ route('tecnicos.show',$tecnico->id) }}">Ver</a>
<a href="{{ route('tecnicos.edit',$tecnico->id) }}">Editar</a>

<form action="{{ route('tecnicos.destroy',$tecnico->id) }}" method="POST">
@csrf
@method('DELETE')
<button type="submit">Excluir</button>
</form>

</td>
</tr>
@endforeach

</table>

@endsection