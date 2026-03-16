@extends('layouts.app')

@section('title', 'Chamados')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold text-gray-800">Chamados</h2>

    <a href="{{ route('chamados.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition">
        Novo Chamado
    </a>
</div>

<form method="GET" action="{{ route('chamados.index') }}"
      class="bg-white p-4 rounded-xl shadow-md mb-6 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
        <select name="prioridade" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white">
            <option value="">Todas</option>
            <option value="baixa" {{ request('prioridade') == 'baixa' ? 'selected' : '' }}>Baixa</option>
            <option value="media" {{ request('prioridade') == 'media' ? 'selected' : '' }}>Média</option>
            <option value="alta" {{ request('prioridade') == 'alta' ? 'selected' : '' }}>Alta</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select name="status" class="w-full border border-gray-300 rounded-lg px-3 py-2 bg-white">
            <option value="">Todos</option>
            <option value="aberto" {{ request('status') == 'aberto' ? 'selected' : '' }}>Aberto</option>
            <option value="em_atendimento" {{ request('status') == 'em_atendimento' ? 'selected' : '' }}>Em Atendimento</option>
            <option value="resolvido" {{ request('status') == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
            <option value="fechado" {{ request('status') == 'fechado' ? 'selected' : '' }}>Fechado</option>
        </select>
    </div>

    <div class="flex gap-2 md:col-span-2">
        <button type="submit"
                class="bg-gray-800 hover:bg-black text-white px-4 py-2 rounded-lg transition">
            Filtrar
        </button>

        <a href="{{ route('chamados.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">
            Limpar
        </a>
    </div>
</form>

<div class="bg-white rounded-xl shadow-md overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-4 text-left text-sm font-semibold">ID</th>
                    <th class="p-4 text-left text-sm font-semibold">Título</th>
                    <th class="p-4 text-left text-sm font-semibold">Prioridade</th>
                    <th class="p-4 text-left text-sm font-semibold">Status</th>
                    <th class="p-4 text-left text-sm font-semibold">Técnico</th>
                    <th class="p-4 text-left text-sm font-semibold">Categoria</th>
                    <th class="p-4 text-left text-sm font-semibold">Tempo restante</th>
                    <th class="p-4 text-left text-sm font-semibold">Ações</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse($chamados as $chamado)
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
                            $classeTempo = 'text-gray-500 font-semibold';
                        } elseif ($minutosRestantes < 0) {
                            $textoTempo = 'Atrasado ' . $tempoFormatado;
                            $classeTempo = 'text-red-600 font-semibold';
                        } else {
                            $textoTempo = $tempoFormatado . ' restantes';

                            $metadePrazoMinutos = ($slaHoras * 60) / 2;

                            if ($minutosRestantes > $metadePrazoMinutos) {
                                $classeTempo = 'text-green-600 font-semibold';
                            } else {
                                $classeTempo = 'text-yellow-600 font-semibold';
                            }
                        }

                        if ($chamado->prioridade == 'alta') {
                            $classePrioridade = 'text-red-600 font-semibold';
                        } elseif ($chamado->prioridade == 'media') {
                            $classePrioridade = 'text-yellow-600 font-semibold';
                        } else {
                            $classePrioridade = 'text-green-600 font-semibold';
                        }
                    @endphp

                    <tr class="hover:bg-gray-50">
                        <td class="p-4 text-gray-700">{{ $chamado->id }}</td>

                        <td class="p-4 text-gray-700">{{ $chamado->titulo }}</td>

                        <td class="p-4 {{ $classePrioridade }}">
                            {{ ucfirst($chamado->prioridade) }}
                        </td>

                        <td class="p-4 text-gray-700">
                            {{ ucfirst(str_replace('_', ' ', $chamado->status)) }}
                        </td>

                        <td class="p-4 text-gray-700">
                            {{ $chamado->tecnico->nome ?? '-' }}
                        </td>

                        <td class="p-4 text-gray-700">
                            {{ $chamado->categoria->nome ?? '-' }}
                        </td>

                        <td class="p-4 {{ $classeTempo }}">
                            {{ $textoTempo }}
                        </td>

                        <td class="p-4">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('chamados.show', $chamado->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1.5 rounded-md">
                                    Ver
                                </a>

                                <a href="{{ route('chamados.edit', $chamado->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1.5 rounded-md">
                                    Editar
                                </a>

                                <form action="{{ route('chamados.destroy', $chamado->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir este chamado?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded-md">
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="p-6 text-center text-gray-500">
                            Nenhum chamado encontrado.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection