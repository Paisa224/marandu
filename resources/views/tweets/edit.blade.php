@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 main-content">
            <div class="card">
                <div class="card-header bg-primary text-white">Editar Tweet</div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                            <br>
                            <small>Actualizado hace {{ \Carbon\Carbon::parse(session('updated_at'))->diffForHumans() }}</small>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('tweets.update', $tweet->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group mb-3">
                            <label for="content">Contenido</label>
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required>{{ $tweet->content }}</textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
