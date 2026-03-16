@extends('layouts.app')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Detalhes da Categoria</h2>
        <a href="{{ route('categorias.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
            Voltar
        </a>
    </div>

    <div class="space-y-4">
        <div>
            <span class="block text-sm font-medium text-gray-500">ID</span>
            <p class="text-lg text-gray-800">{{ $categoria->id }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Nome</span>
            <p class="text-lg text-gray-800">{{ $categoria->nome }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">SLA (horas)</span>
            <p class="text-lg text-gray-800">{{ $categoria->sla_horas }}</p>
        </div>
    </div>
</div>
@endsection
