@extends('layouts.app')

@section('content')

<h2>Nova Categoria</h2>

<form action="{{ route('categorias.store') }}" method="POST">
    @csrf

    @include('categorias._form')

</form>

@endsection