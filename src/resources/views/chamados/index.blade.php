@extends('layouts.app')

@section('content')

<h2>Chamados</h2>

<a href="{{ route('chamados.create') }}">Novo Chamado</a>

<br><br>

<form method="GET" action="{{ route('chamados.index') }}">
    <label>Prioridade</label>
    <select name="prioridade">
        <option value="">Todas</option>
        <option value="baixa" {{ request('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
        <option value="media" {{ request('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
        <option value="alta" {{ request('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
    </select>

    <label>Status</label>
    <select name="status">
        <option value="">Todos</option>
        <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
        <option value="em_atendimento" {{ request('status') == 'em_atendimento' ? 'selected' : '' }}>Em Atendimento</option>
        <option value="resolvido" {{ request('status') == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
        <option value="fechado" {{ request('status') == 'fechado' ? 'selected' : '' }}>Fechado</option>
    </select>

    <button type="submit">Filtrar</button>
    <a href="{{ route('chamados.index') }}">Limpar</a>
</form>

<br>

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
        <td
            @if($chamado->prioridade == 'alta')
            style="color:red; font-weight:bold;"
            @elseif($chamado->prioridade == 'media')
            style="color:orange; font-weight:bold;"
            @elseif($chamado->prioridade == 'baixa')
            style="color:green; font-weight:bold;"
            @endif
            >
            {{ $chamado->prioridade }}
        </td>
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