<div>
    <label for="nome" class="block text-sm font-medium text-gray-700 mb-1">Nome</label>
    <input
        type="text"
        id="nome"
        name="nome"
        value="{{ old('nome', $categoria->nome ?? '') }}"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('nome')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="sla_horas" class="block text-sm font-medium text-gray-700 mb-1">SLA (horas)</label>
    <input
        type="number"
        id="sla_horas"
        name="sla_horas"
        value="{{ old('sla_horas', $categoria->sla_horas ?? '') }}"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('sla_horas')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center gap-3 pt-2">
    <button
        type="submit"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition"
    >
        Salvar
    </button>

    <a
        href="{{ route('categorias.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-5 py-2.5 rounded-lg transition"
    >
        Voltar
    </a>
</div>