@extends('layouts.auth_layout')

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Iniciar Sesión</h1>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">{{ __('Nombre de Usuario') }}</label>
            <input id="username" type="text" placeholder="Usuario Creado" minlength="5" maxlength="15" pattern="[a-zA-Z0-9_]+" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
            @error('username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
            <input id="password" type="password" placeholder="Contraseña" pattern="[a-zA-Z0-9]+" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="current-password">
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4 flex items-center">
            <input class="form-check-input h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="ml-2 block text-sm text-gray-900" for="remember">{{ __('Recuérdame') }}</label>
        </div>
        <button type="submit" class="w-full py-2 mb-4 text-xl text-center bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-600">{{ __('Iniciar sesión') }}</button>
        @if (Route::has('password.request'))
            <a class="text-blue-500 hover:underline mt-4 block text-center" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
        @endif
    </form>
    <p class="text-xl mt-4 text-center">¿No tienes cuenta? <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Crear cuenta</a></p>
</div>
@endsection
