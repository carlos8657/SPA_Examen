# Proyecto Laravel + Inertia + Vue 3

Aplicación de gestión de **Usuarios** y **Equipos**, construida con:

- **Laravel**
- **Vue**
- **Inertia.js**
- **TailwindCSS**
- **Headless UI**
- **MySQL**

---

## Requisitos

- PHP `^8.2`
- Composer
- Node.js `^18`
- npm `^9`
- XAMPP ( se usa para PHP y MySQL si ya los tienes no es necesario)
---

## Instalación

### 1.-Clona el repositorio
```
git clone https://github.com/carlos8657/SPA_Examen
cd SPA_Examen
```
### 2️.-Instala dependencias de PHP y JS
```
composer install
npm install
```
### 3️.-Copia el archivo de entorno
```
cp .env.example .env
```
### 4️.-Genera la clave de aplicación
```
php artisan key:generate
```
### 5.-Configuración de base de datos
Crea una base de datos nueva en un gestor de base de datos 
```
CREATE DATABASE SPA;
```
### 6.-Configura las credenciales de tu base de datos en .env:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=SPA
DB_USERNAME=root
DB_PASSWORD=
```
### 7.- Ejecutar migraciones y seeders
```
php artisan migrate:fresh --seed
```
### 8.-Levantar el servicio con 
```
composer run dev
```
### Usuario para acceder al sistema
**Usuario:** Administrador
**Correo:** admin@admin.com
**Contraseña:** 12345678

