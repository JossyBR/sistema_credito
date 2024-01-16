# Aplicación de Gestión de Créditos

Esta aplicación es un sistema desarrollado en Laravel para la gestión de créditos. Ofrece funcionalidades para el manejo de usuarios y créditos, con roles y permisos específicos.

## Requisitos Previos

Antes de comenzar, asegúrate de tener instalado:

- PHP (Versión 8.1.6)
- Composer
- MySQL
- Node.js y NPM (para compilar assets con Laravel Mix)

## Instalación

### Clonar el Repositorio
git clone https://github.com/JossyBR/sistema_credito.git
cd sistema_credito


### Instalar Dependencias

composer install
npm install
npm run dev


### Configurar la Base de Datos

1. Crea una base de datos en MySQL llamada `sistema_credito`.
2. Configura el archivo `.env` con las credenciales de tu base de datos.

    ```
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=sistema_credito
    DB_USERNAME=tu_usuario_mysql
    DB_PASSWORD=tu_contraseña_mysql
    ```

3. Ejecuta las migraciones y seeders:

    ```
    php artisan migrate
    php artisan db:seed
    ```

## Ejecución

Para iniciar la aplicación, ejecuta:
php artisan serve

Visita `http://localhost:8000` en tu navegador.

## Credenciales de Acceso

- **Super Administrador**
  - Email: sofi@gmail.com
  - Contraseña: admin1234

- **Gerente General**
  - Email: gerentegeneral@gmail.com
  - Contraseña: gerente1234

## Tecnologías y Paquetes Utilizados

- Laravel (Framework de PHP)
- Bootstrap (Framework de CSS)
- Spatie Laravel-Permission (Para la gestión de roles y permisos)
- Laravel UI (Para la generación de la interfaz de autenticación)

