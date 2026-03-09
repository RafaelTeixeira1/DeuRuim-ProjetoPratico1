@extends('layouts.app')

@section('content')

<h2>Editar Categoria</h2>

<form action="{{ route('categorias.update',$categoria->id) }}" method="POST">
    @csrf
    @method('PUT')

    @include('categorias._form')

</form>

@endsection