<!-- resources/views/welcome.blade.php -->
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
            <h1 class="text-4xl md:text-5xl mb-4">Bienvenido a Marandu</h1>
            <p class="text-xl md:text-2xl mb-4">Únete hoy</p>
            <a href="{{ route('register') }}" class="w-full max-w-xs md:max-w-md py-2 mb-2 text-xl md:text-2xl text-center bg-blue-500 text-white rounded-lg">Crear cuenta</a>
            <p class="text-xl md:text-2xl mb-4">¿Ya tienes una cuenta?</p>
            <a href="{{ route('login') }}" class="w-full max-w-xs md:max-w-md py-2 mb-2 text-xl md:text-2xl text-center bg-gray-700 text-white rounded-lg">Iniciar sesión</a>
        </div>
    </div>
    <footer class="text-center py-4 bg-white text-black fixed bottom-0 w-full">
        &copy; 2024 Marandu. Todos los derechos reservados.
    </footer>
</body>
</html>
