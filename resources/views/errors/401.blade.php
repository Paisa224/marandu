@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-1">401</h1>
    <p class="lead">No estás autenticado. Por favor, inicia sesión para continuar.</p>
    <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión</a>
</div>
@endsection
