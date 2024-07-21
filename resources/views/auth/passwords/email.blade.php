@extends('layouts.auth_layout')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">{{ __('Restablecer la contraseña') }}</h1>
    @if (session('status'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('status') }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Dirección de correo electrónico') }}</label>
            <input id="email" type="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="w-full py-2 mb-4 text-xl text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">
            {{ __('Enviar enlace para restablecer contraseña') }}
        </button>
    </form>
</div>
@endsection
