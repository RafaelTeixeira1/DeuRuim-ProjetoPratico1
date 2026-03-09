@extends('layouts.app')

@section('content')

<h2>Novo Técnico</h2>

<form action="{{ route('tecnicos.store') }}" method="POST">
@csrf

@include('tecnicos._form')

</form>

@endsection