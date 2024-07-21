@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 main-content">
            <h1>Explorar</h1>
            @if($tweets->isEmpty())
                <p>No hay tweets para mostrar</p>
            @else
                @foreach($tweets as $tweet)
                    <div class="tweet mb-3 p-3 border rounded">
                        <p>{{ $tweet->content }}</p>
                        <small>Publicado por <a href="{{ route('user.show', $tweet->user->username) }}">{{ $tweet->user->name }}</a> el {{ $tweet->created_at->format('d M Y, H:i') }}</small>
                        <hr>
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
                <div class="mt-3">
                    {{ $tweets->links() }}
                </div>
            @endif
        </div>

        <div class="col-md-4 sidebar-right">
            <div class="accordion mt-4" id="sidebarAccordion">
                <div class="card">
                    <div class="card-header bg-primary text-white" id="headingTrends">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTrends" aria-expanded="true" aria-controls="collapseTrends">
                                Tendencias
                            </button>
                        </h5>
                    </div>
                    <div id="collapseTrends" class="collapse show" aria-labelledby="headingTrends" data-bs-parent="#sidebarAccordion">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach($trendingTweets as $tweet)
                                    <li class="list-group-item">
                                        <a href="{{ route('user.show', $tweet->user->username) }}">{{ $tweet->content }}</a>
                                        <span class="badge bg-primary">{{ $tweet->likes_count }} likes</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header bg-primary text-white" id="headingSuggestions">
                        <h5 class="mb-0">
                            <button class="btn btn-link text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSuggestions" aria-expanded="true" aria-controls="collapseSuggestions">
                                Usuarios sugeridos
                            </button>
                        </h5>
                    </div>
                    <div id="collapseSuggestions" class="collapse show" aria-labelledby="headingSuggestions" data-bs-parent="#sidebarAccordion">
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
                            <a href="{{ route('suggestions') }}" class="btn btn-link mt-2">Mostrar más</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
