@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="display-1">404</h1>
    <p class="lead">Lo sentimos, la página que estás buscando no se pudo encontrar.</p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Volver al inicio</a>
</div>
@endsection
