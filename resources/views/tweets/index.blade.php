@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Publicar un Tweet') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tweets.store') }}">
                        @csrf

                        <div class="form-group">
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="3" required>{{ old('content') }}</textarea>

                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Publicar') }}</button>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">{{ __('Tweets Recientes') }}</div>

                <div class="card-body">
                    @foreach ($tweets as $tweet)
                        <div class="media mb-3">
                            <div class="media-body">
                                <h5 class="mt-0">{{ $tweet->user->name }}</h5>
                                {{ $tweet->content }}
                                <p class="text-muted">{{ $tweet->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
