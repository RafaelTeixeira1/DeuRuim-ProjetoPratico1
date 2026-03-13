@extends('layouts.app')

@section('title','Chamados')

@section('content')

<style>
    .prioridade-alta { color: red; font-weight: bold; }
    .prioridade-media { color: orange; font-weight: bold; }
    .prioridade-baixa { color: green; font-weight: bold; }

    .tempo-verde { color: green; font-weight: bold; }
    .tempo-laranja { color: orange; font-weight: bold; }
    .tempo-vermelho { color: red; font-weight: bold; }
    .tempo-cinza { color: gray; font-weight: bold; }
</style>

<div class="flex justify-between items-center mb-6">

    <h2 class="text-2xl font-semibold text-gray-700">
        Chamados
    </h2>

    <a href="{{ route('chamados.create') }}"
    class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
        Novo Chamado
    </a>

</div>


<form method="GET" action="{{ route('chamados.index') }}" class="bg-white p-4 rounded shadow mb-6 flex gap-4 items-center">

    <div>
        <label class="block text-sm text-gray-600">Prioridade</label>
        <select name="prioridade" class="border rounded px-2 py-1">
            <option value="">Todas</option>
            <option value="baixa" {{ request('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
            <option value="media" {{ request('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
            <option value="alta" {{ request('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
        </select>
    </div>

    <div>
        <label class="block text-sm text-gray-600">Status</label>
        <select name="status" class="border rounded px-2 py-1">
            <option value="">Todos</option>
            <option value="aberto">Aberto</option>
            <option value="em_atendimento">Em Atendimento</option>
            <option value="resolvido">Resolvido</option>
            <option value="fechado">Fechado</option>
        </select>
    </div>

    <button type="submit"
    class="bg-gray-800 text-white px-3 py-1 rounded hover:bg-black">
        Filtrar
    </button>

    <a href="{{ route('chamados.index') }}"
    class="text-gray-600 hover:underline">
        Limpar
    </a>

</form>


<div class="bg-white rounded shadow overflow-hidden">

<table class="w-full">

    <thead class="bg-gray-200 text-gray-700">

        <tr>
            <th class="p-3 text-left">ID</th>
            <th class="p-3 text-left">Título</th>
            <th class="p-3 text-left">Prioridade</th>
            <th class="p-3 text-left">Status</th>
            <th class="p-3 text-left">Técnico</th>
            <th class="p-3 text-left">Categoria</th>
            <th class="p-3 text-left">Tempo restante</th>
            <th class="p-3 text-left">Ações</th>
        </tr>

    </thead>

<tbody>

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
    $tempoFormatado = $horas.'h '.$minutos.'m';
} elseif ($horas > 0) {
    $tempoFormatado = $horas.'h';
} else {
    $tempoFormatado = $minutos.'m';
}

if ($tempoEncerrado) {
    $textoTempo = 'Encerrado';
    $classeTempo = 'tempo-cinza';
} elseif ($minutosRestantes < 0) {
    $textoTempo = 'Atrasado '.$tempoFormatado;
    $classeTempo = 'tempo-vermelho';
} else {
    $textoTempo = $tempoFormatado.' restantes';

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

<tr class="border-t hover:bg-gray-50">

<td class="p-3">{{ $chamado->id }}</td>

<td class="p-3">{{ $chamado->titulo }}</td>

<td class="p-3 {{ $classePrioridade }}">
{{ ucfirst($chamado->prioridade) }}
</td>

<td class="p-3">
{{ ucfirst(str_replace('_',' ',$chamado->status)) }}
</td>

<td class="p-3">
{{ $chamado->tecnico->nome ?? '-' }}
</td>

<td class="p-3">
{{ $chamado->categoria->nome ?? '-' }}
</td>

<td class="p-3 {{ $classeTempo }}">
{{ $textoTempo }}
</td>

<td class="p-3 space-x-2">

<a href="{{ route('chamados.show',$chamado->id) }}"
class="text-blue-600 hover:underline">
Ver
</a>

<a href="{{ route('chamados.edit',$chamado->id) }}"
class="text-yellow-600 hover:underline">
Editar
</a>

<form action="{{ route('chamados.destroy',$chamado->id) }}" method="POST" class="inline">

@csrf
@method('DELETE')

<button type="submit" class="text-red-600 hover:underline">
Excluir
</button>

</form>

</td>

</tr>

@endforeach

</tbody>

</table>

</div>

@endsection