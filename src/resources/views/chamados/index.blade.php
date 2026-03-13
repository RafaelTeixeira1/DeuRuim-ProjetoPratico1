@extends('layouts.app')

@section('content')

<style>
    .prioridade-alta {
        color: red;
        font-weight: bold;
    }

    .prioridade-media {
        color: orange;
        font-weight: bold;
    }

    .prioridade-baixa {
        color: green;
        font-weight: bold;
    }

    .tempo-verde {
        color: green;
        font-weight: bold;
    }

    .tempo-laranja {
        color: orange;
        font-weight: bold;
    }

    .tempo-vermelho {
        color: red;
        font-weight: bold;
    }

    .tempo-cinza {
        color: gray;
        font-weight: bold;
    }
</style>

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

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Prioridade</th>
        <th>Status</th>
        <th>Técnico</th>
        <th>Categoria</th>
        <th>Tempo restante</th>
        <th>Ações</th>
    </tr>

    @foreach($chamados as $chamado)
        @php
            $slaHoras = $chamado->categoria->sla_horas ?? 0;
            $prazo = \Carbon\Carbon::parse($chamado->data_abertura)->addHours($slaHoras);
            $minutosRestantes = now()->diffInMinutes($prazo, false);

            $tempoEncerrado = in_array($chamado->status, ['resolvido', 'fechado']);

            $minutosAbsolutos = abs($minutosRestantes);
            $horas = floor($minutosAbsolutos / 60);
            $minutos = $minutosAbsolutos % 60;

            if ($horas > 0 && $minutos > 0) {
                $tempoFormatado = $horas . 'h ' . $minutos . 'm';
            } elseif ($horas > 0) {
                $tempoFormatado = $horas . 'h';
            } else {
                $tempoFormatado = $minutos . 'm';
            }

            if ($tempoEncerrado) {
                $textoTempo = 'Encerrado';
                $classeTempo = 'tempo-cinza';
            } elseif ($minutosRestantes < 0) {
                $textoTempo = 'Atrasado ' . $tempoFormatado;
                $classeTempo = 'tempo-vermelho';
            } else {
                $textoTempo = $tempoFormatado . ' restantes';

                $metadePrazoMinutos = ($slaHoras * 60) / 2;

                if ($minutosRestantes > $metadePrazoMinutos) {
                    $classeTempo = 'tempo-verde';
                } else {
                    $classeTempo = 'tempo-laranja';
                }
            }

            if ($chamado->prioridade == 'alta') {
                $classePrioridade = 'prioridade-alta';
            } elseif ($chamado->prioridade == 'media') {
                $classePrioridade = 'prioridade-media';
            } else {
                $classePrioridade = 'prioridade-baixa';
            }
        @endphp

        <tr>
            <td>{{ $chamado->id }}</td>
            <td>{{ $chamado->titulo }}</td>
            <td class="{{ $classePrioridade }}">
                {{ ucfirst($chamado->prioridade) }}
            </td>
            <td>{{ ucfirst(str_replace('_', ' ', $chamado->status)) }}</td>
            <td>{{ $chamado->tecnico->nome ?? '-' }}</td>
            <td>{{ $chamado->categoria->nome ?? '-' }}</td>
            <td class="{{ $classeTempo }}">
                {{ $textoTempo }}
            </td>
            <td>
                <a href="{{ route('chamados.show', $chamado->id) }}">Ver</a>
                <a href="{{ route('chamados.edit', $chamado->id) }}">Editar</a>

                <form action="{{ route('chamados.destroy', $chamado->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>

@endsection