<!-- resources/views/search/results.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resultados de la búsqueda para "{{ $query }}"</div>
                <div class="card-body">
                    <h4>Usuarios</h4>
                    @if($users->isEmpty())
                        <p>No se encontraron usuarios</p>
                    @else
                        <ul>
                            @foreach($users as $user)
                                <li>
                                    {{ $user->name }} ({{ $user->username }})
                                    @if(!Auth::user()->followings->contains($user->id))
                                        <form action="{{ route('follow', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-link">Seguir</button>
                                        </form>
                                    @else
                                        <form action="{{ route('unfollow', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-link">Dejar de Seguir</button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h4 class="mt-4">Tweets</h4>
                    @if($tweets->isEmpty())
                        <p>No se encontraron tweets</p>
                    @else
                        @foreach($tweets as $tweet)
                            <div class="tweet">
                                <p>{{ $tweet->content }}</p>
                                <small>Publicado por {{ $tweet->user->name }} el {{ $tweet->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            <hr>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
