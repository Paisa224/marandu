<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Marandu') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <!-- Style -->
    <link href="{{ asset('css/autlayout.css') }}" rel="stylesheet">

</head>
<body class="bg-white text-black font-sans">
    <div class="flex h-screen">
        <div class="flex-1 flex items-center justify-center bg-gray-100">
            <a href="{{ url('/') }}" class="logo">M<span class="logo-text">arandu</span></a>
        </div>
        <div class="flex-1 flex flex-col justify-center items-center p-8">
            @yield('content')
        </div>
    </div>
    <div class="text-center py-4 bg-white text-black fixed bottom-0 w-full">
        &copy; 2024 Marandu. Todos los derechos reservados.
    </div>
</body>
</html>
