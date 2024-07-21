<!DOCTYPE html>
<html>
<head>
    <title>Código de verificación</title>
</head>
<body>
    <p>Hola,</p>
    <p>Gracias por registrarte en nuestra plataforma. Tu código de verificación es:</p>
    <h2>{{ $code }}</h2>
    <p>Por favor, no compartas este código con nadie. Si no solicitaste este código, ignora este correo.</p>
    <p>Atentamente,<br>El equipo de {{ config('app.name') }}</p>
</body>
</html>
