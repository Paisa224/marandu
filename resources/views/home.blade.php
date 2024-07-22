@extends('layouts.app')

@section('sidebar-right')
<div class="accordion mt-4" id="sidebarAccordion">
    <div class="card">
        <div class="card-header bg-primary text-white" id="headingProfile">
            <h5 class="mb-0">
                <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile">
                    {{ Auth::user()->name }}
                </button>
            </h5>
        </div>

        <div id="collapseProfile" class="collapse show" aria-labelledby="headingProfile" data-bs-parent="#sidebarAccordion">
            <div class="card-body">
                <p><strong>Seguidores:</strong> {{ $followersCount }}</p>
                <p><strong>Seguidos:</strong> {{ $followingsCount }}</p>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white" id="headingOne">
            <h5 class="mb-0">
                <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Seguidores
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#sidebarAccordion">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($followers as $follower)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('user.show', $follower->username) }}" class="text-dark fw-bold">{{ $follower->name }}</a>
                            <br>
                            <small class="text-muted">{{ '@'.$follower->username }}</small>
                        </div>
                        @if(!Auth::user()->followings->contains($follower))
                        <form action="{{ route('follow', $follower->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-primary btn-sm">Seguir</button>
                        </form>
                        @else
                        <form action="{{ route('unfollow', $follower->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Dejar de Seguir</button>
                        </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('profile') }}#followers" class="btn btn-link mt-2">Mostrar más</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white" id="headingTwo">
            <h5 class="mb-0">
                <button class="btn btn-link text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Usuarios Seguidos
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-bs-parent="#sidebarAccordion">
            <div class="card-body">
                <ul class="list-group list-group-flush">
                    @foreach($followings as $following)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <a href="{{ route('user.show', $following->username) }}" class="text-dark fw-bold">{{ $following->name }}</a>
                            <br>
                            <small class="text-muted">{{ '@'.$following->username }}</small>
                        </div>
                        <form action="{{ route('unfollow', $following->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Dejar de Seguir</button>
                        </form>
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('profile') }}#followings" class="btn btn-link mt-2">Mostrar más</a>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-primary text-white" id="headingThree">
            <h5 class="mb-0">
                <button class="btn btn-link text-white collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    A quién seguir
                </button>
            </h5>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-bs-parent="#sidebarAccordion">
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
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9 col-lg-8 main-content">
            <div class="card mb-2">
                <div class="card-header">
                    <span>{{ Auth::user()->name }} ({{ Auth::user()->username }})</span>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('search') }}">
                        <div class="input-group">
                            <input type="text" class="form-control" name="query" placeholder="Buscar palabras, usuarios o #">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-2">
                <div class="card-header">¿Qué estás pensando?</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf
                        <div class="form-group">
                            <textarea id="content" class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required></textarea>
                            @error('content')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Publicar</button>
                    </form>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">Tweets Recientes</div>
                <div class="card-body">
                    @if($tweets->isEmpty())
                    <p>No hay tweets para mostrar</p>
                    @else
                    @foreach($tweets as $tweet)
                    <div class="tweet mb-2 p-3 border rounded">
                        <div class="d-flex align-items-center mb-2">
                            <div>
                                <a href="{{ route('user.show', $tweet->user->username) }}" class="text-dark fw-bold">
                                    <strong>{{ $tweet->user->name }}</strong>
                                </a>
                                <span class="text-muted">
                                    <a href="{{ route('user.show', $tweet->user->username) }}" class="text-muted">
                                        {{ '@'.$tweet->user->username }}
                                    </a>
                                </span>
                                <span class="text-muted">· {{ $tweet->created_at->diffForHumans() }}</span>
                            </div>
                            @if(Auth::check() && Auth::id() != $tweet->user->id && !Auth::user()->followings->contains($tweet->user))
                            <form action="{{ route('follow', $tweet->user->id) }}" method="POST" class="ms-auto">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">Seguir</button>
                            </form>
                            @endif
                        </div>
                        <p>{{ $tweet->content }}</p>
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <div>
                                @if($tweet->likes->contains(Auth::id()))
                                <form action="{{ route('tweets.unlike', $tweet->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-danger"><i class="fas fa-heart"></i></button>
                                </form>
                                @else
                                <form action="{{ route('tweets.like', $tweet->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-link p-0 text-muted"><i class="far fa-heart"></i></button>
                                </form>
                                @endif
                                <span class="text-muted ms-1">{{ $tweet->likes->count() }}</span>
                            </div>
                            <div>
                                <button class="btn btn-link p-0 text-muted"><i class="far fa-comment"></i></button>
                                <span class="text-muted ms-1">{{ $tweet->comments_count }}</span>
                            </div>
                            <div>
                                <button class="btn btn-link p-0 text-muted"><i class="fas fa-retweet"></i></button>
                                <span class="text-muted ms-1">{{ $tweet->retweets_count }}</span>
                            </div>
                            <div>
                                <button class="btn btn-link p-0 text-muted"><i class="far fa-bookmark"></i></button>
                            </div>
                            @if(Auth::id() == $tweet->user->id)
                            <div class="dropdown ms-auto">
                                <button class="btn btn-link p-0 text-muted" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <form action="{{ route('tweets.delete', $tweet->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="dropdown-item text-danger">
                                                <i class="fas fa-trash-alt"></i> Borrar
                                            </button>
                                        </form>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('tweets.edit', $tweet->id) }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                    </li>
                                </ul>
                            </div>
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
