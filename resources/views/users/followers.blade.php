@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1>Seguidores</h1>
            <ul class="list-group">
                @foreach($followers as $follower)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $follower->name }}
                        @if (!auth()->user()->following->contains($follower))
                            <form action="{{ route('users.follow', $follower) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Seguir</button>
                            </form>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
