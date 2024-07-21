<!-- resources/views/auth/passwords/reset.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Marandu') }}</title>
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-white text-black font-sans">
    <div class="flex flex-col md:flex-row h-screen">
        <div class="flex-1 flex items-center justify-center bg-gray-100 p-4">
            <a href="{{ url('/') }}" class="logo text-5xl font-bold">M<span class="logo-text">arandu</span></a>
        </div>
        <div class="flex-1 flex flex-col justify-center items-center p-8 bg-white">
            <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-6">
                <h1 class="text-4xl mb-6 text-center">{{ __('Restablecer la Contraseña') }}</h1>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="mb-4">
                        <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Dirección de Correo Electrónico') }}</label>
                        <input id="email" type="email" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">{{ __('Contraseña') }}</label>
                        <input id="password" type="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500 @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password-confirm" class="block text-sm font-medium text-gray-700">{{ __('Confirmar Contraseña') }}</label>
                        <input id="password-confirm" type="password" class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <button type="submit" class="w-full py-2 mb-4 text-xl text-center bg-blue-500 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                        {{ __('Restablecer Contraseña') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
    <footer class="text-center py-4 bg-white text-black fixed bottom-0 w-full">
        &copy; 2024 Marandu. Todos los derechos reservados.
    </footer>
</body>
</html>
