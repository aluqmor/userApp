# Aplicación de Gestión de Usuarios

Esta es una aplicación web desarrollada en Laravel que permite crear, editar y eliminar tanto usuarios como administradores.

## Características

- Creación de usuarios
- Verificación de cuenta por email
- Posibilidad de editar nombre de usuario, email y contraseña del propio usuario
- Posibilidad de crear, editar, verificar y eliminar usuarios para los administradores


![1](images/1.jpg)


![2](images/2.jpg)


![3](images/3.jpg)


![4](images/4.jpg)


## Instalación

Sigue estos pasos para descargar y configurar el repositorio:

1. Clona el repositorio:

    ```sh
    git clone https://github.com/aluqmor/userApp.git
    ```

2. Navega al directorio del proyecto:

    ```sh
    cd tu-repositorio
    ```

3. Instala las dependencias de Composer:

    ```sh
    composer install
    ```

4. Copia el archivo database.sql y crea la base de datos junto con usuario y contraseña.

5. Cambia el nombre de `.env.example` a `.env`.

6. Configura tu base de datos en el archivo `.env`:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```
    
7. Configura el email por defecto en el archivo `.env`:

   ```env
    MAIL_MAILER=log
    MAIL_HOST=127.0.0.1
    MAIL_PORT=2525
    MAIL_USERNAME=null
    MAIL_PASSWORD=null
    MAIL_ENCRYPTION=null
    MAIL_FROM_ADDRESS="hello@example.com"
    MAIL_FROM_NAME="${APP_NAME}"
    ```

8. Genera la clave de la aplicación:

    ```sh
    php artisan key:generate
    ```

9. Ejecuta las migraciones para crear las tablas necesarias:

    ```sh
    php artisan migrate
    ```
