@extends('layouts.app')

@section('title', 'Notificaciones')

@section('content')
<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card mb-4 shadow-lg rounded-lg">
                <div class="card-body">
                    <h3 class="text-xl font-bold">Notificaciones</h3>
                    @if($notifications->isEmpty())
                        <p class="text-muted">No tienes notificaciones.</p>
                    @else
                        @foreach($notifications as $notification)
                            <div class="notification alert alert-info d-flex justify-content-between align-items-center mb-3 shadow-sm rounded-lg">
                                <div>
                                    @if(isset($notification->data['liker']))
                                        <strong>{{ $notification->data['liker'] }}</strong> le dio like a tu tweet.
                                    @elseif(isset($notification->data['follower']))
                                        <strong>{{ $notification->data['follower'] }}</strong> ha publicado un nuevo tweet.
                                    @endif
                                    <div class="text-muted">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                @if(is_null($notification->read_at))
                                    <a href="{{ route('notifications.markAsRead', $notification->id) }}" class="btn btn-sm btn-primary">Marcar como leída</a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .notification {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection
