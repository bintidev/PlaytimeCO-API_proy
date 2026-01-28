# PlaytimeCO API

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

## 🎮 Acerca de PlaytimeCO API

**PlaytimeCO API** es una API REST desarrollada internamente para **Playtime Co**, la compañía de juguetes basada en el videojuego ***Poppy Playtime***. Esta API gestiona la autenticación y administración de usuarios del ecosistema de la plataforma.

Actualmente, la API se enfoca en proporcionar funcionalidades de **autenticación de usuarios**, permitiendo registro, inicio de sesión, cierre de sesión y consulta de usuarios.

---

## 🛠️ Tecnologías Utilizadas

Esta API está construida con las siguientes tecnologías:

- **PHP** - Lenguaje de programación del servidor
- **Laravel** - Framework web poderoso
- **Composer** - Gestor de dependencias de PHP
- **MySQL/MariaDB** - Base de datos relacional
- **XAMPP** - Paquete que incluye Apache, MySQL y PHP
- **Postman** - Cliente HTTP para pruebas

---

## 📋 Requisitos Previos

Asegúrate de tener instalados los siguientes componentes:

- **XAMPP** (con Apache y MySQL habilitados)
- **PHP 8.0** o superior
- **Composer**
- **Postman** (para pruebas de endpoints)

## ⚙️ Instalación y Configuración

### 1. Clonar el Repositorio

```bash
git clone https://github.com/bintidev/PlaytimeCO-API_proy.git
```

### 2. Instalar Dependencias

```bash
composer install
```

### 3. Configurar el Archivo .env

Copia el archivo de ejemplo y configura tus variables de entorno:

```bash
cp .env.example .env
```

**Parámetros de Base de Datos a Configurar (usando XAMPP):**

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=playtime_co
DB_USERNAME=root
DB_PASSWORD=
```

> ⚠️ **Nota:** XAMPP utiliza `root` como usuario por defecto sin contraseña.

### 4. Ejecutar Migraciones

```bash
php artisan migrate
```

### 5. Iniciar el Servidor de Desarrollo

```bash
php artisan serve
```

El servidor estará disponible en `http://localhost:8000`

---

## 📁 Estructura del Proyecto

```
PlaytimeCO-api/
├── app/
│   ├── Models/              # Modelos de datos
│   │   └── User.php         # Modelo de usuario
│   └── Http/
│       └── Controllers/     # Controladores de la API
│           └── AuthController.php  # Controlador de autenticación
├── routes/
│   ├── api.php              # Rutas de la API
├── database/
│   ├── migrations/          # Migraciones de base de datos
│   └── seeders/             # Datos de prueba
├── pictures/                # Capturas de pantalla de endpoints
├── user.json                # Ejemplos de usuarios para pruebas
└── README.md                # Este archivo
```

---

## 🔐 Endpoints Disponibles

La API proporciona los siguientes endpoints para la autenticación de usuarios:

### 1. **Listar Todos los Usuarios**
- **Ruta:** `GET /api/users`
- **Descripción:** Obtiene la lista completa de todos los usuarios registrados en el sistema
- **Autenticación:** No requerida
- **Captura:** ![Users List](pictures/users-list.png)

### 2. **Registro de Usuario**
- **Ruta:** `POST /api/register`
- **Descripción:** Crea una nueva cuenta de usuario y devuelve un token de autenticación
- **Autenticación:** No requerida
- **Campos requeridos:**
  - `name` (string, máx. 255 caracteres)
  - `email` (email único)
  - `password` (string, mínimo 8 caracteres, debe estar confirmado)
- **Captura:** ![Register](pictures/register-user.png)

### 3. **Inicio de Sesión**
- **Ruta:** `POST /api/login`
- **Descripción:** Autentica un usuario existente validando sus credenciales
- **Autenticación:** No requerida
- **Campos requeridos:**
  - `name` (string)
  - `email` (email)
  - `password` (string)
- **Captura:** ![Login](pictures/login.png)

### 4. **Cerrar Sesión**
- **Ruta:** `POST /api/logout`
- **Descripción:** Invalida todos los tokens del usuario autenticado, cerrando su sesión
- **Autenticación:** Requerida (Bearer Token)
- **Captura:** ![Logout](pictures/logout.png)

---

## 🧪 Pruebas con Postman

### Pasos para Comenzar:

1. **Abre Postman** en tu máquina
2. **Crea una nueva colección** para la API de PlaytimeCO
3. **Carga usuarios de ejemplo** desde el archivo `user.json`
4. **Asegúrate de que XAMPP esté ejecutándose** (Apache y MySQL activos)

### ⚠️ Importante: Gestión de Tokens

Cuando realices un registro exitoso, recibirás un **token de autenticación**. Este token debe ser almacenado en las **cabeceras (Headers)** de todas las peticiones subsecuentes que lo requieran:

```
Authorization: Bearer {tu_token_aqui}
```

**Ejemplo en Postman:**
1. Ve a la pestaña **Headers**
2. Añade una nueva fila con:
   - **Key:** `Authorization`
   - **Value:** `Bearer 1|eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...`

> 💡 **Consejo:** Guarda el token en una variable de Postman para usarlo automáticamente en múltiples requests.

---

## 📊 Archivo de Ejemplo: user.json

Utiliza el archivo `user.json` para importar usuarios de prueba en Postman:

```json
{
  "name": "Usuario Prueba",
  "email": "usuario@playtime.co",
  "password": "SecurePassword123!",
  "password_confirmation": "SecurePassword123!"
}
```
