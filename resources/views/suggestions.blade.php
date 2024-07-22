@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5>Sugerencias</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($suggestions as $suggestion)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <a href="{{ route('user.show', $suggestion->username) }}" class="text-dark fw-bold">{{ $suggestion->name }}</a>
                                <br>
                                <small class="text-muted">{{ '@'.$suggestion->username }}</small>
                            </div>
                            <form action="{{ route('follow', $suggestion->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">Seguir</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
