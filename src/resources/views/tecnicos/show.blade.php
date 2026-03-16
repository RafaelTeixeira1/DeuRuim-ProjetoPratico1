@extends('layouts.app')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Detalhes do Técnico</h2>
        <a href="{{ route('tecnicos.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
            Voltar
        </a>
    </div>

    <div class="space-y-4">
        <div>
            <span class="block text-sm font-medium text-gray-500">ID</span>
            <p class="text-lg text-gray-800">{{ $tecnico->id }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Nome</span>
            <p class="text-lg text-gray-800">{{ $tecnico->nome }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Email</span>
            <p class="text-lg text-gray-800">{{ $tecnico->email }}</p>
        </div>

        <div>
            <span class="block text-sm font-medium text-gray-500">Especialidade</span>
            <p class="text-lg text-gray-800">{{ $tecnico->especialidade }}</p>
        </div>
    </div>
</div>
@endsection
