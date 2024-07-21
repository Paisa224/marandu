@extends('layouts.auth_layout')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Crear Cuenta</h1>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Nombre Completo') }}</label>
            <input id="name" type="text" placeholder="Escribe tu Nombre" minlength="5" maxlength="40" pattern="[a-zA-Z\s]+" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="username" class="block text-sm font-medium text-gray-700">{{ __('Nombre de Usuario') }}</label>
            <input id="username" type="text" placeholder="Elige un nombre de usuario" minlength="5" maxlength="20" pattern="[a-zA-Z0-9_]+" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('username') border-red-500 @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
            @error('username')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Correo Electrónico') }}</label>
            <input id="email" type="email" placeholder="Escribe el Correo con el cual deseas registrarte" maxlength="100" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
            @error('email')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
            <input id="password" type="password" placeholder="Favor tener en cuenta letras y números para mayor seguridad" pattern="[a-zA-Z0-9]+" minlength="8" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <div class="mb-4">
            <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
            <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" pattern="[a-zA-Z0-9]+" minlength="8" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="password_confirmation" required autocomplete="new-password">
        </div>
        <button type="submit" class="w-full py-2 mb-4 text-xl bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ __('Registrar') }}</button>
    </form>
    <p class="text-center text-xl mt-4 text-gray-700">¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Iniciar sesión</a></p>
</div>
@endsection
