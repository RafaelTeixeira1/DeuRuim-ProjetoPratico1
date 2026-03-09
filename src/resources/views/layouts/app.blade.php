<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Chamados</title>
</head>
<body>

<h1>Sistema de Chamados</h1>

<nav>
    <a href="{{ route('chamados.index') }}">Chamados</a> |
    <a href="{{ route('tecnicos.index') }}">Técnicos</a> |
    <a href="{{ route('categorias.index') }}">Categorias</a>
</nav>

<hr>

@yield('content')

</body>
</html>