<label>Título</label>
<input type="text" name="titulo" value="{{ old('titulo', $chamado->titulo ?? '') }}">
<br>

<label>Descrição</label>
<textarea name="descricao">{{ old('descricao', $chamado->descricao ?? '') }}</textarea>
<br>

<label>Prioridade</label>
<select name="prioridade">
    <option value="baixa">Baixa</option>
    <option value="media">Média</option>
    <option value="alta">Alta</option>
</select>
<br>

<label>Status</label>
<select name="status">
    <option value="aberto">Aberto</option>
    <option value="em_atendimento">Em Atendimento</option>
    <option value="resolvido">Resolvido</option>
    <option value="fechado">Fechado</option>
</select>
<br>

<label>Data de abertura</label>
<input type="datetime-local" name="data_abertura"
    value="{{ old('data_abertura', isset($chamado) ? \Carbon\Carbon::parse($chamado->data_abertura)->format('Y-m-d\TH:i') : '') }}">
<br>

<label>Técnico</label>
<select name="tecnico_id">
    @foreach($tecnicos as $tecnico)
    <option value="{{ $tecnico->id }}">
        {{ $tecnico->nome }}
    </option>
    @endforeach
</select>
<br>

<label>Categoria</label>
<select name="categoria_id">
    @foreach($categorias as $categoria)
    <option value="{{ $categoria->id }}">
        {{ $categoria->nome }}
    </option>
    @endforeach
</select>
<br>

<button type="submit">Salvar</button>