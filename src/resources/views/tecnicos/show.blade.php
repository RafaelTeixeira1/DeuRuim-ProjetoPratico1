@extends('layouts.app')

@section('content')

<h2>Detalhes do Técnico</h2>

<p><b>ID:</b> {{ $tecnico->id }}</p>
<p><b>Nome:</b> {{ $tecnico->nome }}</p>
<p><b>Email:</b> {{ $tecnico->email }}</p>
<p><b>Especialidade:</b> {{ $tecnico->especialidade }}</p>

<a href="{{ route('tecnicos.index') }}">Voltar</a>

@endsection