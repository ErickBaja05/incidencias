# 🎫 Sistema de Tickets de Incidencias Técnicas (SIT)

Este proyecto consiste en una aplicación web desarrollada en **PHP** y **MySQL** para la gestión y reporte de incidencias técnicas dentro de una organización. Fue realizado como parte de la asignatura de **Aplicaciones Web**, aplicando conceptos fundamentales como métodos HTTP, manejo de sesiones, validación de formularios, cabeceras de estado HTTP y conexión a bases de datos.

## 👨‍💻 Desarrolladores

* **Erick Bajaña**
* **Franciel Tipantuña**
* **Andrés Veas**
* **Sabina Zabala**

## 📋 Descripción del Proyecto

El Sistema de Incidencias Técnicas (SIT) permite a los usuarios autenticarse y reportar inconvenientes que surgen al interactuar con los sistemas de la empresa para que el equipo de TI pueda darles seguimiento y solución.

### Funcionalidades principales:

1. **Autenticación y Manejo de Sesiones (`index.php`):**
   * Inicio de sesión validado contra la base de datos MySQL.
   * Protección de rutas privadas: todas las pantallas verifican que exista una sesión activa antes de mostrar el contenido.
   * Visualización del nombre del usuario autenticado en todo momento y opción para cerrar sesión (destruyendo la sesión activa).

2. **Listado de Incidencias (`listar.php`):**
   * Muestra únicamente las incidencias registradas por el usuario que ha iniciado sesión, indicando su ID autoincremental y su título/nombre.
   * Permite navegar hacia el detalle de cada incidencia o hacia el formulario de creación.

3. **Detalle de Incidencia (`detalle.php`):**
   * Despliega la información completa de un ticket seleccionado: ID, Nombre, Descripción y Prioridad.

4. **Registro y Validación de Incidencias (`registrar.php`):**
   * Formulario para crear nuevos tickets especificando Nombre, Descripción y Prioridad (*Alta, Media, Baja*).
   * Validación de caracteres especiales prohibidos (como `$`, `\`, `=`, `[`, `]`) para prevenir entradas inválidas.

5. **Manejo de Códigos de Estado HTTP (`201.php`, `400.php`, `500.php`):**
   * **201 Created (`201.php`):** Se muestra y envía en la cabecera HTTP cuando una incidencia se guarda exitosamente.
   * **400 Bad Request (`400.php`):** Se activa cuando fallan las validaciones de los campos del formulario.
   * **500 Internal Server Error (`500.php`):** Se presenta cuando ocurre algún problema de conexión o consulta con la base de datos (permite regresar al login destruyendo la sesión).

## 🛠️ Requisitos Previos

Para ejecutar este proyecto en un entorno local bajo **Windows**, necesitas tener instalado:

* **XAMPP** (que incluye el servidor web Apache y el gestor de base de datos MySQL/MariaDB).
* Un navegador web moderno.

## 🚀 Instrucciones de Instalación y Ejecución (Windows)

Sigue estos pasos para poner en marcha el sistema en tu máquina local:

### 1. Configurar el directorio del proyecto

1. Descarga o clona este repositorio.
2. Asegúrate de que la carpeta del proyecto se llame exactamente **`incidencias`**.
3. Copia y pega la carpeta `incidencias` dentro del directorio `htdocs` de tu instalación de XAMPP (por defecto suele estar en `C:\xampp\htdocs\`).

### 2. Iniciar los servicios en XAMPP

1. Abre el **XAMPP Control Panel**.
2. Inicia el módulo **Apache** haciendo clic en su botón *Start*.
3. Inicia el módulo **MySQL** haciendo clic en su botón *Start*.

### 3. Configurar la Base de Datos y el Usuario en MySQL

1. Entra a **phpMyAdmin** abriendo tu navegador e ingresando a: `http://localhost/phpmyadmin/`
2. **Crear la Base de Datos:**
   * Crea una nueva base de datos llamada exactamente **`incidencias`**.
   * Importa el archivo `.sql` (script de base de datos incluido en la carpeta del proyecto) dentro de la base de datos `incidencias` para generar las tablas correspondientes (`usuario`, `incidencia`, etc.).
3. **Configurar el Usuario de Base de Datos:**
   * El sistema se conecta utilizando las siguientes credenciales que deben existir en tu motor MySQL:
     * **Usuario:** `user`
     * **Contraseña:** `12345`
   * *Cómo crearlo rápidamente en phpMyAdmin:* Ve a la pestaña **Cuentas de usuarios** -> **Agregar cuenta de usuario** (o ejecuta el siguiente comando en la pestaña **SQL**):

     ```sql
     CREATE DATABASE IF NOT EXISTS incidencias;
     CREATE USER IF NOT EXISTS 'user'@'localhost' IDENTIFIED BY '12345';
     GRANT ALL PRIVILEGES ON incidencias.* TO 'user'@'localhost';
     FLUSH PRIVILEGES;
     ```

### 4. Script de Usuarios de Prueba (Para Iniciar Sesión)

Ejecuta el seed.sql dentro de bdd/ en la base de datos incidencias. Luego, inserta usuarios para hacer pruebas con este script:

```bash
php -r '
require "C:\xampp\htdocs\incidencias\bdd\UsuarioDAO.php"; #Reemplaza aquí con la ruta correcta.
$dao = new UsuarioDAO();
$dao->insertar("admin", "admin");
$dao->insertar("erick", "12345");
$dao->insertar("sabina", "12345");
$dao->insertar("andres", "12345");
$dao->insertar("anderson", "12345");
echo "5 usuarios insertados correctamente\n";
'
```

**Credenciales listas para probar en el Login (`index.php`):**
* **Usuario:** `pedro` | **Clave:** `12345`
* **Usuario:** `luis` | **Clave:** `12345`
* **Usuario:** `admin` | **Clave:** `admin123`

### 5. Ejecutar la aplicación

1. Abre tu navegador web.
2. Ingresa a la siguiente URL:

   ```text
   http://localhost/incidencias/index.php
   ```

3. Inicia sesión con cualquiera de las credenciales de prueba creadas en el paso anterior para comenzar a listar y registrar tickets.

## 📂 Estructura de Archivos Principales

```text
incidencias/
├── index.php       # Pantalla de Login y validación de credenciales
├── listar.php      # Listado de tickets del usuario activo
├── detalle.php     # Vista detallada de un ticket específico
├── registrar.php   # Formulario de creación y validación de tickets
├── 201.php         # Respuesta HTTP 201 (Incidencia creada con éxito)
├── 400.php         # Respuesta HTTP 400 (Error de validación de datos)
├── 500.php         # Respuesta HTTP 500 (Error interno / Base de datos)
└── script.sql      # Script de creación e inserción de la Base de Datos
```
