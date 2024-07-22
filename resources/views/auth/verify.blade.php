@extends('layouts.auth_layout')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@section('content')
<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-4xl font-bold text-center mb-6 text-gray-800">Verificación de Cuenta</h1>
    @if (session('resent'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Un nuevo enlace de verificación ha sido enviado a tu dirección de correo electrónico.') }}
        </div>
    @endif
    <div class="mb-4">
        {{ __('Antes de continuar, por favor verifica tu correo electrónico para un enlace de verificación.') }}
        {{ __('Si no recibiste el correo electrónico') }},
    </div>
    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="w-full py-2 mb-4 text-xl bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ __('haz clic aquí para solicitar otro') }}</button>
    </form>
    <form method="POST" action="{{ route('verify.post') }}">
        @csrf
        <div class="mb-4">
            <label for="verification_code" class="block text-sm font-medium text-gray-700">{{ __('Código de Verificación') }}</label>
            <input id="verification_code" type="text" placeholder="Ingresa el Código de Verificación" minlength="4" maxlength="4" pattern="\d{4}" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('verification_code') border-red-500 @enderror" name="verification_code" required>
            @error('verification_code')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>
        <button type="submit" class="w-full py-2 mb-4 text-xl bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">{{ __('Verificar') }}</button>
    </form>
</div>
@endsection
