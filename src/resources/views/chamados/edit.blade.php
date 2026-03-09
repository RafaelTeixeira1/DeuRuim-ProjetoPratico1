@extends('layouts.app')

@section('content')

<h2>Editar Chamado</h2>

<form action="{{ route('chamados.update',$chamado->id) }}" method="POST">
@csrf
@method('PUT')

@include('chamados._form')

</form>

@endsection