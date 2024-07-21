@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Siguiendo</h1>
            <ul class="list-group">
                @foreach($following as $user)
                    <li class="list-group-item">{{ $user->name }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
