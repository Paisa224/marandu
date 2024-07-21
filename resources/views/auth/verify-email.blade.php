<!DOCTYPE html>
<html>
<head>
    <title>Verificar Correo Electrónico</title>
</head>
<body>
    <h1>Verifica Tu Dirección Correo Electrónico</h1>
    @if (session('resent'))
        <p>Un nuevo enlace de verificación ha sido enviado a tu dirección de correo electrónico.</p>
    @endif

    <p>Antes de continuar, por favor revisa tu correo electrónico para encontrar el enlace de verificación.</p>
    <p>Si no recibiste el correo electrónico, <a href="{{ route('verification.resend') }}" onclick="event.preventDefault(); document.getElementById('resend-form').submit();">haz clic aquí para solicitar otro</a>.</p>

    <form id="resend-form" action="{{ route('verification.resend') }}" method="POST" style="display: none;">
        @csrf
    </form>
</body>
</html>
