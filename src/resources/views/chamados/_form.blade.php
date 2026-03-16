<div>
    <label for="titulo" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
    <input
        type="text"
        id="titulo"
        name="titulo"
        value="{{ old('titulo', $chamado->titulo ?? '') }}"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('titulo')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div>
    <label for="descricao" class="block text-sm font-medium text-gray-700 mb-1">Descrição</label>
    <textarea
        id="descricao"
        name="descricao"
        rows="4"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >{{ old('descricao', $chamado->descricao ?? '') }}</textarea>
    @error('descricao')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label for="prioridade" class="block text-sm font-medium text-gray-700 mb-1">Prioridade</label>
        <select
            id="prioridade"
            name="prioridade"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        >
            <option value="">Selecione</option>
            <option value="baixa" {{ old('prioridade', $chamado->prioridade ?? '') == 'baixa' ? 'selected' : '' }}>Baixa</option>
            <option value="media" {{ old('prioridade', $chamado->prioridade ?? '') == 'media' ? 'selected' : '' }}>Média</option>
            <option value="alta" {{ old('prioridade', $chamado->prioridade ?? '') == 'alta' ? 'selected' : '' }}>Alta</option>
        </select>
        @error('prioridade')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
        <select
            id="status"
            name="status"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        >
            <option value="">Selecione</option>
            <option value="aberto" {{ old('status', $chamado->status ?? '') == 'aberto' ? 'selected' : '' }}>Aberto</option>
            <option value="em_atendimento" {{ old('status', $chamado->status ?? '') == 'em_atendimento' ? 'selected' : '' }}>Em Atendimento</option>
            <option value="resolvido" {{ old('status', $chamado->status ?? '') == 'resolvido' ? 'selected' : '' }}>Resolvido</option>
            <option value="fechado" {{ old('status', $chamado->status ?? '') == 'fechado' ? 'selected' : '' }}>Fechado</option>
        </select>
        @error('status')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div>
    <label for="data_abertura" class="block text-sm font-medium text-gray-700 mb-1">Data de abertura</label>
    <input
        type="datetime-local"
        id="data_abertura"
        name="data_abertura"
        value="{{ old('data_abertura', isset($chamado) ? $chamado->data_abertura->format('Y-m-d\TH:i') : '') }}"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
    >
    @error('data_abertura')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">
    <div>
        <label for="tecnico_id" class="block text-sm font-medium text-gray-700 mb-1">Técnico</label>
        <select
            id="tecnico_id"
            name="tecnico_id"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        >
            <option value="">Selecione</option>
            @foreach($tecnicos as $tecnico)
                <option value="{{ $tecnico->id }}"
                    {{ old('tecnico_id', $chamado->tecnico_id ?? '') == $tecnico->id ? 'selected' : '' }}>
                    {{ $tecnico->nome }}
                </option>
            @endforeach
        </select>
        @error('tecnico_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="categoria_id" class="block text-sm font-medium text-gray-700 mb-1">Categoria</label>
        <select
            id="categoria_id"
            name="categoria_id"
            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
        >
            <option value="">Selecione</option>
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}"
                    {{ old('categoria_id', $chamado->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>
        @error('categoria_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
</div>

<div class="flex items-center gap-3 pt-2">
    <button
        type="submit"
        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg transition"
    >
        Salvar
    </button>

    <a
        href="{{ route('chamados.index') }}"
        class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-medium px-5 py-2.5 rounded-lg transition"
    >
        Voltar
    </a>
</div>