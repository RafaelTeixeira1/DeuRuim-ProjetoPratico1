@extends('layouts.app')

@section('content')
<div class="max-w-3xl bg-white rounded-xl shadow-md p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Novo Chamado</h2>

    <form action="{{ route('chamados.store') }}" method="POST" class="space-y-5">
        @csrf
        @include('chamados._form')
    </form>
</div>
@endsection