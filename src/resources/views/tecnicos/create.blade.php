@extends('layouts.app')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-md p-6">
    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Novo Técnico</h2>

    <form action="{{ route('tecnicos.store') }}" method="POST" class="space-y-5">
        @csrf
        @include('tecnicos._form')
    </form>
</div>
@endsection
