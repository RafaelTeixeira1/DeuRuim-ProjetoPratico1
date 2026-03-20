@extends('layouts.app')

@section('content')
<div class="bg-white rounded-xl shadow-md p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-semibold text-gray-800">Categorias</h2>
        <a href="{{ route('categorias.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg transition">
            Nova Categoria
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">ID</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">Nome</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">SLA (horas)</th>
                    <th class="text-left px-4 py-3 text-sm font-semibold text-gray-700">Ações</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($categorias as $categoria)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-gray-700">{{ $categoria->id }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $categoria->nome }}</td>
                        <td class="px-4 py-3 text-gray-700">{{ $categoria->sla_horas }}</td>
                        <td class="px-4 py-3">
                            <div class="flex flex-wrap gap-2">
                                <a href="{{ route('categorias.show', $categoria->id) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white text-sm px-3 py-1.5 rounded-md">
                                    Ver
                                </a>

                                <a href="{{ route('categorias.edit', $categoria->id) }}"
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white text-sm px-3 py-1.5 rounded-md">
                                    Editar
                                </a>

                                <form action="{{ route('categorias.destroy', $categoria->id) }}"
                                      method="POST"
                                      class="inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
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
                        <td colspan="4" class="px-4 py-6 text-center text-gray-500">
                            Nenhuma categoria cadastrada.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
