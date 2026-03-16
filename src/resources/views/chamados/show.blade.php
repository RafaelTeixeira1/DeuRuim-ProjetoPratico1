@extends('layouts.app')

@section('content')
<div class="max-w-3xl bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Detalhes do Chamado</h2>

        <a href="{{ route('chamados.index') }}"
           class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-4 py-2 rounded-lg transition">
            Voltar
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <div>
            <span class="block text-sm font-medium text-gray-500">ID</span>
            <p class="text-lg text-gray-800">{{ $chamado->id }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Título</span>
            <p class="text-lg text-gray-800">{{ $chamado->titulo }}</p>
        </div>

        <div class="md:col-span-2">
            <span class="block text-sm font-medium text-gray-500">Descrição</span>
            <p class="text-lg text-gray-800">{{ $chamado->descricao }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Prioridade</span>
            <p class="text-lg text-gray-800">{{ ucfirst($chamado->prioridade) }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Status</span>
            <p class="text-lg text-gray-800">{{ ucfirst(str_replace('_', ' ', $chamado->status)) }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Data de abertura</span>
            <p class="text-lg text-gray-800">
                {{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y H:i') }}
            </p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Técnico</span>
            <p class="text-lg text-gray-800">{{ $chamado->tecnico->nome ?? '-' }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Categoria</span>
            <p class="text-lg text-gray-800">{{ $chamado->categoria->nome ?? '-' }}</p>
        </div>
    </div>
</div>
@endsection