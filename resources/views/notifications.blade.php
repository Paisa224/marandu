@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Notificaciones</h1>
    @if($notifications->isEmpty())
        <p>No tienes notificaciones</p>
    @else
        <ul class="list-group">
            @foreach($notifications as $notification)
                <li class="list-group-item">
                    {{ $notification->data['message'] }}
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
