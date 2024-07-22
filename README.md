
# Marandu

Marandu es una aplicación de microblogging inspirada en Twitter que permite a los usuarios publicar y compartir mensajes cortos, seguir a otros usuarios y más.

## Descripción

Marandu es una aplicación web que permite a los usuarios registrarse, iniciar sesión y compartir pensamientos en forma de tweets. Los usuarios pueden seguir a otros, ver su feed personal y descubrir contenido popular.

## Características

- Registro e inicio de sesión de usuarios
- Publicación de tweets
- Seguimiento y dejar de seguir a usuarios
- Feed personal
- Descubrimiento de contenido popular

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

    ```bash
    git clone https://github.com/Paisa224/marandu
    cd marandu
    ```

2. Instala las dependencias del backend:

    ```bash
    composer install
    ```

3. Instala las dependencias del frontend:

    ```bash
    npm install
    ```

4. Configura el archivo `.env`:

    - Crea una base de datos llamada `marandu`.
    - Deja la configuración de envío de correo para validación mediante código como está ("Ajustar .env exable a .env"). La contraseña es la de la aplicación y se eliminará una vez me confirmen que terminaron con las pruebas.
    - Configura la base de datos en el archivo `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=marandu
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5. Ejecuta las migraciones y seeders:

    ```bash
    php artisan migrate --seed
    ```

6. Inicia el servidor de desarrollo:

    ```bash
    php artisan serve
    ```

7. Compila los recursos del frontend:

    ```bash
    npm run dev
    ```

## Uso

1. Inicia el servidor:

    ```bash
    php artisan serve
    ```

    Visita `http://localhost:8000` en tu navegador.

2. Regístrate con un correo válido. Si no deseas proporcionar uno, puedes usar el siguiente usuario de prueba:

    - Usuario: segel
    - Contraseña: segel123

    Es obligatorio ejecutar el siguiente query en tu base de datos:

    ```sql
    UPDATE users SET email_verified_at = NOW() WHERE username = 'segel';
    ```

    O desde la terminal:

    ```bash
    php artisan tinker
    $user = App\Models.User::where('username', 'segel')->first();
    $user->email_verified_at = now();
    $user->save();
    ```

    Al ejecutar el comando `seeders`, se crean automáticamente 10 usuarios aleatorios para interactuar.

3. ¡Comienza a publicar tus pensamientos y sigue a otros usuarios!

## Licencia

Distribuido bajo la Licencia MIT. Ver `LICENSE` para más información.

## Contacto

**Manuel Salinas**

Link del Proyecto: [https://github.com/Paisa224/marandu]
