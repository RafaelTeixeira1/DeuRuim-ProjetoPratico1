@extends('layouts.app')

@section('content')

<h2>Detalhes da Categoria</h2>

<p><b>ID:</b> {{ $categoria->id }}</p>
<p><b>Nome:</b> {{ $categoria->nome }}</p>
<p><b>SLA:</b> {{ $categoria->sla_horas }}</p>

<a href="{{ route('categorias.index') }}">Voltar</a>

@endsection