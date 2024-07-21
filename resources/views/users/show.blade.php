@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <!-- Perfil Header -->
            <div class="card mb-4">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3>{{ $user->username }}</h3>
                        <div class="d-flex align-items-center">
                            <a href="#tweets" class="me-3">{{ $tweets->count() }} Tweets</a>
                            <a href="#followers" class="me-3" data-bs-toggle="modal" data-bs-target="#followersModal">{{ $followersCount }} seguidores</a>
                            <a href="#followings" data-bs-toggle="modal" data-bs-target="#followingsModal">{{ $followingsCount }} seguidos</a>
                        </div>
                        <div class="mt-2">
                            <p>{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        @if(Auth::id() === $user->id)
                            <a href="{{ route('profile') }}" class="btn btn-outline-primary me-2">Ir a mi perfil</a>
                        @else
                            <form action="{{ route('follow', $user->id) }}" method="POST">
                                @csrf
                                @if(Auth::user()->followings->contains($user))
                                    <button type="submit" class="btn btn-outline-danger me-2">Dejar de seguir</button>
                                @else
                                    <button type="submit" class="btn btn-outline-primary me-2">Seguir</button>
                                @endif
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Tweets Section -->
            <div id="tweets" class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5>Tweets</h5>
                </div>
                <div class="card-body">
                    @foreach($tweets as $tweet)
                        <div class="tweet mb-3">
                            <strong>{{ $tweet->user->name }}</strong> · <span>{{ $tweet->created_at->diffForHumans() }}</span>
                            <p>{{ $tweet->content }}</p>
                            <div class="tweet-actions">
                                <!-- Acciones de tweet, como like, retweet, etc. -->
                                @if(Auth::id() == $tweet->user->id)
                                    <a href="{{ route('tweets.edit', $tweet->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                @endif
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Seguidores -->
<div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="followersModalLabel">Seguidores</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="followersSearch" class="form-control mb-3" placeholder="Buscar seguidores...">
                <ul class="list-group" id="followersList">
                    @foreach($followers as $follower)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $follower->name }}</strong> ({{ '@'.$follower->username }})
                        </div>
                        @if(Auth::id() !== $follower->id)
                            <form action="{{ route(Auth::user()->followings->contains($follower) ? 'unfollow' : 'follow', $follower->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-{{ Auth::user()->followings->contains($follower) ? 'danger' : 'primary' }} btn-sm">
                                    {{ Auth::user()->followings->contains($follower) ? 'Dejar de Seguir' : 'Seguir' }}
                                </button>
                            </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Seguidos -->
<div class="modal fade" id="followingsModal" tabindex="-1" aria-labelledby="followingsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="followingsModalLabel">Usuarios Seguidos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="followingsSearch" class="form-control mb-3" placeholder="Buscar seguidos...">
                <ul class="list-group" id="followingsList">
                    @foreach($followings as $following)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $following->name }}</strong> ({{ '@'.$following->username }})
                        </div>
                        @if(Auth::id() !== $following->id)
                            <form action="{{ route('unfollow', $following->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm">Dejar de Seguir</button>
                            </form>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('followersSearch').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let followersList = document.getElementById('followersList');
        let followers = followersList.getElementsByTagName('li');
        Array.from(followers).forEach(function(follower) {
            let text = follower.textContent || follower.innerText;
            if (text.toLowerCase().indexOf(filter) > -1) {
                follower.style.display = "";
            } else {
                follower.style.display = "none";
            }
        });
    });

    document.getElementById('followingsSearch').addEventListener('input', function() {
        let filter = this.value.toLowerCase();
        let followingsList = document.getElementById('followingsList');
        let followings = followingsList.getElementsByTagName('li');
        Array.from(followings).forEach(function(following) {
            let text = following.textContent || following.innerText;
            if (text.toLowerCase().indexOf(filter) > -1) {
                following.style.display = "";
            } else {
                following.style.display = "none";
            }
        });
    });
</script>
@endsection
