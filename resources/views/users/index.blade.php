@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuarios') }}</div>

                <div class="card-body">
                    <form method="GET" action="{{ route('users.search') }}">
                        <div class="form-group">
                            <input type="text" name="query" class="form-control" placeholder="Buscar usuarios...">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ __('Buscar') }}</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Lista de Usuarios') }}</div>

                <div class="card-body">
                    @foreach ($users as $user)
                        <div class="media mb-3">
                            <div class="media-body">
                                <h5 class="mt-0"><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></h5>
                                <p class="text-muted">{{ $user->username }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
