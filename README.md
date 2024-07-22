# Marandu

Marandu es una aplicación de microblogging inspirada en Twitter. 
Permite a los usuarios publicar y compartir mensajes cortos, seguir a otros usuarios y más.

## Descripción

Marandu es una aplicación web que permite a los usuarios registrarse, iniciar sesión y compartir pensamientos en forma de tweets. 
Los usuarios pueden seguir a otros, ver su feed personal y descubrir contenido popular.

## Características

- Registro e inicio de sesión de usuarios.
- Publicación de tweets.
- Seguimiento y dejar de seguir a usuarios.
- Feed personal.
- Descubrimiento de contenido popular.

## Tecnologías Utilizadas

- **Backend:** Laravel
- **Frontend:** Vue.js
- **Base de Datos:** MySQL
- **Autenticación:** Laravel Passport
- **Despliegue:** Docker

## Requisitos Previos

- PHP >= 7.4
- Composer
- Node.js & npm
- Docker

## Instalación

1. Clona el repositorio:

    bash

    git clone https://github.com/Paisa224/marandu

    cd marandu
    

2. Instala las dependencias del backend:

    bash

    composer install
   

3. Instala las dependencias del frontend:

    bash

    npm install
  

4. La configuracion de .env

    Deje una configuracion apta para su uso,
    Favor crear base de datos: marandu
    Deje la configuracion de envio de correo para validacion mediante codigo "NO TOCAR .ENV"
    La contraseña es la de la aplicacion por lo tanto es seguro, se eliminara una vez me confirme que haya probado todo.
   

5. Configura la base de datos en el archivo `.env`:
    env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=marandu
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    
6. Ejecuta las migraciones y seeders:

    bash
    
    php artisan migrate --seed

7. Inicia el servidor de desarrollo:

    bash
    php artisan serve
    
8. Compila los recursos del frontend:
    bash
    npm run dev

## Uso

1. Inicia el servidor:

bash

php artisan serve


Visita `http://localhost:8000` en tu navegador.

2. Regístate con un correo valido porfavor(En todo caso que no quiera proporciono un user de prueba),

user: segel
pass: segel123

Es obligatorio que ejecute el siguiente query dentro de su base de datos:

    *UPDATE users SET email_verified_at = NOW() WHERE username = 'segel';*

    o desde la terminal

    bash
    php artisan tinker
    $user = App\Models\User::where('username', 'segel')->first();
    $user->email_verified_at = now();
    $user->save();

Al ejecutar el comando seeders se crean automaticamente 10 users randoms a modo de poder interactuar

3. ¡Comienza a publicar tus pensamientos y sigue a otros usuarios!

## Licencia

Distribuido bajo la Licencia MIT. Ver `LICENSE` para más información.

## Contacto

Tu Nombre - Manuel Salinas 

Link del Proyecto: https://github.com/Paisa224/marandu
