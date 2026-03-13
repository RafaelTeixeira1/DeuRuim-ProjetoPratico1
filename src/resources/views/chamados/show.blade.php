@extends('layouts.app')

@section('content')

<h2>Detalhes do Chamado</h2>

<p><b>ID:</b> {{ $chamado->id }}</p>
<p><b>Titulo:</b> {{ $chamado->titulo }}</p>
<p><b>Descrição:</b> {{ $chamado->descricao }}</p>
<p><b>Prioridade:</b> {{ $chamado->prioridade }}</p>
<p><b>Data de abertura:</b> {{ \Carbon\Carbon::parse($chamado->data_abertura)->format('d/m/Y H:i') }}</p>
<p><b>Status:</b> {{ $chamado->status }}</p>

<a href="{{ route('chamados.index') }}">Voltar</a>

@endsection