@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Buscar Usuarios') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('users.search') }}">
                        <div class="form-group">
                            <input type="text" name="query" class="form-control" placeholder="Buscar usuarios..." value="{{ old('query', $query ?? '') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Resultados de la búsqueda') }}</div>

                <div class="card-body">
                    @if($users->isEmpty())
                        <p>No se encontraron usuarios.</p>
                    @else
                        @foreach ($users as $user)
                            <div class="media mb-3">
                                <div class="media-body">
                                    <h5 class="mt-0"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></h5>
                                    <p class="text-muted">{{ $user->username }}</p>
                                    @if (!auth()->user()->following->contains($user))
                                        <form action="{{ route('users.follow', $user) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary">Seguir</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
