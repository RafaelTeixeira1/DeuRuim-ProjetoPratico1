@extends('layouts.app')

@section('content')

<h2>Editar Técnico</h2>

<form action="{{ route('tecnicos.update',$tecnico->id) }}" method="POST">
@csrf
@method('PUT')

@include('tecnicos._form')

</form>

@endsection