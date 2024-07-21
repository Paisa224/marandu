@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Crear Tweet</h1>
            <form action="{{ route('tweets.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <textarea name="content" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Publicar</button>
            </form>
        </div>
    </div>
</div>
@endsection
