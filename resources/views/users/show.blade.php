@extends('layouts.app')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card mb-4 shadow-lg rounded-lg">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="text-xl font-bold">{{ $user->username }}</h3>
                        <div class="d-flex align-items-center">
                            <a href="#tweets" class="me-3 profile-button">{{ $tweets->count() }} Tweets</a>
                            <a href="#followers" class="me-3 profile-button" data-bs-toggle="modal" data-bs-target="#followersModal">{{ $followersCount }} seguidores</a>
                            <a href="#followings" class="profile-button" data-bs-toggle="modal" data-bs-target="#followingsModal">{{ $followingsCount }} seguidos</a>
                        </div>
                        <div class="mt-2">
                            <p class="text-lg">{{ $user->name }}</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        @if(Auth::id() == $user->id)
                            <a href="{{ route('settings') }}" class="btn btn-primary me-2">Editar perfil</a>
                        @else
                            <form action="{{ route(Auth::user()->followings->contains($user) ? 'unfollow' : 'follow', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-outline-{{ Auth::user()->followings->contains($user) ? 'danger' : 'primary' }} me-2">
                                    {{ Auth::user()->followings->contains($user) ? 'Dejar de seguir' : 'Seguir' }}
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div id="tweets" class="card mb-3 shadow-lg rounded-lg">
                <div class="card-header bg-primary text-white">
                    <h5>Tweets</h5>
                </div>
                <div class="card-body">
                    @foreach($tweets as $tweet)
                        <div class="tweet mb-3">
                            <strong>{{ $tweet->user->name }}</strong> · <span>{{ $tweet->created_at->diffForHumans() }}</span>
                            <p>{{ $tweet->content }}</p>
                            <div class="tweet-actions mt-2">
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
                            <a href="{{ route('user.show', $follower->username) }}" class="text-dark fw-bold">
                                <strong>{{ $follower->name }}</strong> ({{ '@'.$follower->username }})
                            </a>
                        </div>
                        <form action="{{ route(Auth::user()->followings->contains($follower) ? 'unfollow' : 'follow', $follower->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-{{ Auth::user()->followings->contains($follower) ? 'danger' : 'primary' }} btn-sm">
                                {{ Auth::user()->followings->contains($follower) ? 'Dejar de Seguir' : 'Seguir' }}
                            </button>
                        </form>
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
                            <a href="{{ route('user.show', $following->username) }}" class="text-dark fw-bold">
                                <strong>{{ $following->name }}</strong> ({{ '@'.$following->username }})
                            </a>
                        </div>
                        <form action="{{ route(Auth::user()->followings->contains($following) ? 'unfollow' : 'follow', $following->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-outline-{{ Auth::user()->followings->contains($following) ? 'danger' : 'primary' }} btn-sm">
                                {{ Auth::user()->followings->contains($following) ? 'Dejar de Seguir' : 'Seguir' }}
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .profile-button {
        text-decoration: none;
        color: white;
        background-color: #0d6efd;
        padding: 5px 15px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .profile-button:hover {
        background-color: #0b5ed7;
    }

    .profile-button:active {
        background-color: #0a58ca;
    }

    .tweet-actions .btn {
        margin-top: 10px;
    }

    .modal-body input {
        margin-bottom: 15px;
    }
</style>
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
