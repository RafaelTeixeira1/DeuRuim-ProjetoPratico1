<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistema de Chamados')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans">

<div class="max-w-6xl mx-auto p-6">

    <header class="mb-6">
        <h1 class="border-l-8 border-indigo-600 pl-4 text-4xl font-bold text-gray-800">
            Sistema de Chamados
        </h1>
    </header>

    <nav class="mb-6 space-x-4 text-indigo-600 font-medium">
        <a href="{{ route('chamados.index') }}" class="hover:underline">Chamados</a>
        <a href="{{ route('tecnicos.index') }}" class="hover:underline">Técnicos</a>
        <a href="{{ route('categorias.index') }}" class="hover:underline">Categorias</a>
    </nav>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>