<label>Nome</label>
<input type="text" name="nome" value="{{ old('nome', $categoria->nome ?? '') }}">
<br>

<label>SLA (horas)</label>
<input type="number" name="sla_horas" value="{{ old('sla_horas', $categoria->sla_horas ?? '') }}">
<br>

<button type="submit">Salvar</button>