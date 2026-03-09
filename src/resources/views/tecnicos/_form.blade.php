<label>Nome</label>
<input type="text" name="nome" value="{{ old('nome', $tecnico->nome ?? '') }}">
<br>

<label>Email</label>
<input type="email" name="email" value="{{ old('email', $tecnico->email ?? '') }}">
<br>

<label>Especialidade</label>
<input type="text" name="especialidade" value="{{ old('especialidade', $tecnico->especialidade ?? '') }}">
<br>

<button type="submit">Salvar</button>