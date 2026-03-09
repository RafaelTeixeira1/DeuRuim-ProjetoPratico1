@extends('layouts.app')

@section('content')

<h2>Novo Chamado</h2>

<form action="{{ route('chamados.store') }}" method="POST">
@csrf

@include('chamados._form')

</form>

@endsection