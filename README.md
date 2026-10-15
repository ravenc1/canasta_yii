# La Canasta - Torneo Navideño de Básquetbol

Sistema de gestión web desarrollado con **Yii 2 Framework** y **PHP 8** para administrar equipos, jugadores, anotaciones y reportes estadísticos del Torneo Navideño de Básquetbol "La Canasta".

## Grupo 1

- Ricardo Andree Arias Conde — Carné: 5190-19-3821
- Angel Adrian Arias Conde — Carné: 5190-18-16246
- Darlyng Yasmin Marroquín Sosa — Carné: 5190-17-24336

---

## 1. ¿Qué es el proyecto?

"La Canasta" es una aplicación web académica de **Programación Web** que permite gestionar un torneo de básquetbol navideño. Desde su interfaz se puede:

- Administrar **equipos** (alta, edición, eliminación y carga de logo).
- Administrar **jugadores** (datos personales, fotografía y asignación a un equipo).
- Registrar **puntuaciones/tiros** por jugador y jornada.
- Consultar **reportes**: lista general de jugadores, jugadores por equipo y máximos anotadores, además del perfil individual de cada jugador.

La interfaz está personalizada con fondos de pantalla aleatorios, un menú superior de navegación y un estilo semitransparente para no ocultar el fondo.

---

## 2. Cómo clonar y ejecutar el proyecto (paso a paso)

Procedimiento completo para clonar el repositorio en una máquina limpia y dejar la aplicación funcionando. Copia y pega los comandos en tu terminal (**PowerShell/CMD** en Windows, **bash** en Linux/macOS).

> El repositorio ya incluye `config/db.php`, la carpeta `web/assets/` (con `.gitkeep`), `composer.lock` y todas las imágenes de `web/uploads/`, por lo que **no necesitas crearlas a mano**.

### 2.1 Requisitos previos

- **Git** instalado — `git --version`
- **PHP 8.0 o superior** — `php -v`
- **Composer 2** — `composer -V`
- **MySQL / MariaDB** — se recomienda **XAMPP**
- Navegador web moderno

Verifica las extensiones de PHP que necesita Yii 2 con MySQL:

```bash
php -m | findstr /I "pdo_mysql mbstring"   # Windows (CMD/PowerShell)
php -m | grep -Ei "pdo_mysql|mbstring"     # Linux / macOS
```

> Debes ver `pdo_mysql` y `mbstring`. En XAMPP vienen habilitadas por defecto.

### 2.2 Clonar el repositorio

```bash
git clone https://github.com/ravenc1/canasta_yii.git
cd canasta_yii
```

### 2.3 Instalar las dependencias

```bash
composer install
```

Esto crea la carpeta `vendor/` e instala **exactamente** las versiones registradas en `composer.lock` (Yii 2, Bootstrap 5, JQuery UI, SwiftMailer, Debug, Gii, etc.). La instalación es reproducible en cualquier máquina.

### 2.4 Crear la base de datos

Inicia MySQL/MariaDB y crea la base de datos `lacanasta_db` con `utf8mb4`.

**Opción A — línea de comandos (XAMPP en Windows):**

```bash
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS lacanasta_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**Opción B — Linux/macOS o si `mysql` está en el PATH:**

```bash
mysql -u root -e "CREATE DATABASE IF NOT EXISTS lacanasta_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

**Opción C — phpMyAdmin (XAMPP):** entra a `http://localhost/phpmyadmin`, pestaña **Bases de datos**, crea `lacanasta_db` con cotejamiento `utf8mb4_unicode_ci`.

### 2.5 Revisar la conexión en `config/db.php`

El archivo ya viene incluido en el repositorio con los valores típicos de XAMPP:

```php
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=lacanasta_db;charset=utf8mb4',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8mb4',
];
```

Si tu MySQL usa otro usuario, contraseña, host o puerto, edita esos valores y guarda el archivo.

### 2.6 Ejecutar las migraciones (crear tablas + datos iniciales)

```bash
php yii migrate --interactive=0
```

Esto crea las tablas `equipo`, `jugador`, `tipo_tiro` y `puntuacion`, e inserta los datos iniciales: **6 equipos, 30 jugadores (5 por equipo), 3 tipos de tiro y 77 puntuaciones**.

> **¿Ya habías migrado antes y quieres reiniciar los datos?** Revierte y vuelve a migrar:

```bash
php yii migrate/down --all --interactive=0
php yii migrate --interactive=0
```

### 2.7 Levantar el servidor de desarrollo

```bash
php yii serve
```

Abre en el navegador: **`http://localhost:8080/`**

Si el puerto 8080 está ocupado, usa otro puerto:

```bash
php yii serve --port=8081
```

**Opción alternativa con XAMPP (Apache):**

1. Coloca el proyecto dentro de `C:\xampp\htdocs\canasta_yii`.
2. Inicia **Apache** y **MySQL** desde el panel de XAMPP.
3. Abre `http://localhost/canasta_yii/web/`.

> Mantén MySQL encendido mientras uses la aplicación; si está apagado verás errores de conexión en los módulos que consultan la base de datos.

### 2.8 Resumen: clonación completa en un solo bloque

**Windows (PowerShell/CMD) con XAMPP en `C:\xampp`:**

```bash
git clone https://github.com/ravenc1/canasta_yii.git
cd canasta_yii
composer install
C:\xampp\mysql\bin\mysql.exe -u root -e "CREATE DATABASE IF NOT EXISTS lacanasta_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php yii migrate --interactive=0
php yii serve
```

**Linux / macOS:**

```bash
git clone https://github.com/ravenc1/canasta_yii.git
cd canasta_yii
composer install
mysql -u root -e "CREATE DATABASE IF NOT EXISTS lacanasta_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php yii migrate --interactive=0
php yii serve
```

### 2.9 Solución de problemas frecuentes

| Problema | Causa / Solución |
|---|---|
| `InvalidConfigException: The directory does not exist: .../web/assets` | Falta la carpeta `web/assets/`. Está versionada mediante `.gitkeep`, así que con un clon completo debería existir; si la borraste, recréala vacía. |
| `Fatal error: Failed opening required '.../config/db.php'` | Falta `config/db.php`; ya viene en el repositorio. Asegúrate de clonar/actualizar completo. |
| `SQLSTATE[HY000] [2002] Connection refused` | MySQL/MariaDB no está iniciado. Enciéndelo (XAMPP) e intenta de nuevo. |
| `Unknown database 'lacanasta_db'` | No creaste la base de datos. Repite el paso **2.4**. |
| Solo se ven 4 equipos y 12 jugadores | Ejecutaste un seeder antiguo. Haz `git pull` y reinicia la base de datos (paso **2.6**, "reiniciar los datos"). |
| `Class 'yii\...' not found` | No se instalaron las dependencias. Ejecuta `composer install`. |
| El puerto 8080 está ocupado | Usa `php yii serve --port=8081`. |
| No se ven logos, fotos ni fondos | Verifica que exista `web/uploads/` con sus imágenes (vienen versionadas en el repo). |

---

## 3. Cómo se hizo el proyecto (pasos generales)

1. Se creó la estructura base con **Yii 2 Basic Project Template** mediante Composer.
2. Se configuró la conexión a MySQL en `config/db.php`.
3. Se generaron los modelos, controladores y vistas para las entidades principales (equipos, jugadores, puntuaciones) usando Gii.
4. Se crearon las migraciones en `migrations/` para definir las tablas y los datos iniciales.
5. Se desarrollaron las vistas CRUD en `views/` (listado, creación, edición, detalle).
6. Se implementaron los reportes en `controllers/ReportesController.php` y sus vistas.
7. Se personalizó la apariencia en `views/layouts/main.php` y `web/css/site.css`: fondo aleatorio, barra superior, menús desplegables y contenedores semitransparentes.
8. Se agregó el helper `helpers/ImagenHelper.php` para mostrar logos y fotografías guardadas en `web/uploads/`.
9. Se configuró el favicon dinámico desde `web/uploads/icono/`.

---

## 4. Estructura del proyecto y archivos principales

```
canasta_yii/
├── assets/                  # Definición de assets (CSS/JS) de la aplicación
├── commands/                # Comandos de consola
├── config/                  # Configuración de la aplicación
├── controllers/             # Controladores MVC
├── helpers/                 # Clases auxiliares
├── migrations/              # Migraciones y datos iniciales
├── models/                  # Modelos de datos y formularios
├── views/                   # Vistas y layout principal
├── web/                     # Document root (index.php, CSS, uploads)
├── composer.json            # Dependencias del proyecto
├── composer.lock            # Versiones exactas de dependencias
├── yii                      # Script de consola de Yii
└── README.md                # Este archivo
```

### 4.1 Carpeta `assets/`

| Archivo | Descripción |
|---|---|
| `AppAsset.php` | Declara el bundle de recursos de la aplicación. Registra `web/css/site.css` y depende de `YiiAsset`, `BootstrapAsset` y `BootstrapPluginAsset` (Bootstrap 5). |

### 4.2 Carpeta `commands/`

| Archivo | Descripción |
|---|---|
| `SeedController.php` | Comando de consola auxiliar (si se usa para sembrar datos). |

### 4.3 Carpeta `config/`

| Archivo | Descripción |
|---|---|
| `web.php` | Configuración principal de la aplicación web: rutas, componentes (db, request, session, user, etc.) y parámetros. |
| `console.php` | Configuración para ejecutar comandos de consola (`php yii ...`). |
| `db.php` | Credenciales y DSN de conexión a MySQL/MariaDB. |
| `params.php` | Parámetros globales de la aplicación. |

### 4.4 Carpeta `controllers/`

| Archivo | Descripción |
|---|---|
| `SiteController.php` | Controlador del sitio público: inicio (`index`), acerca de (`about`), contacto (`contact`) e inicio de sesión. |
| `EquipoController.php` | CRUD de equipos: listado, creación, edición, detalle y eliminación. |
| `JugadorController.php` | CRUD de jugadores, incluyendo relación con el equipo. |
| `PuntuacionController.php` | Listado y registro de puntuaciones/tiros por jornada. |
| `ReportesController.php` | Reportes: lista general, jugadores por equipo, máximos anotadores y perfil individual. |

### 4.5 Carpeta `helpers/`

| Archivo | Descripción |
|---|---|
| `ImagenHelper.php` | Helper para generar la URL de logos y fotografías subidas en `web/uploads/`. |

### 4.6 Carpeta `migrations/`

| Archivo | Descripción |
|---|---|
| `m241013_000001_create_equipo_table.php` | Crea la tabla `equipo` (id, nombre, logo, fecha de registro). |
| `m241013_000002_create_jugador_table.php` | Crea la tabla `jugador` (datos personales, fotografía y FK a `equipo`). |
| `m241013_000003_create_tipo_tiro_table.php` | Crea la tabla `tipo_tiro` (catálogo de tipos de tiro). |
| `m241013_000004_create_puntuacion_table.php` | Crea la tabla `puntuacion` (jugador, tipo de tiro, cantidad, jornada, fecha). |
| `m241013_000005_seed_data.php` | Inserta los datos iniciales (6 equipos, 30 jugadores, 3 tipos de tiro y 77 puntuaciones). |

### 4.7 Carpeta `models/`

| Archivo | Descripción |
|---|---|
| `Equipo.php` | Modelo ActiveRecord de la tabla `equipo`. |
| `Jugador.php` | Modelo ActiveRecord de la tabla `jugador`, con relación a `Equipo`. |
| `Puntuacion.php` | Modelo ActiveRecord de la tabla `puntuacion`. |
| `TipoTiro.php` | Modelo ActiveRecord de la tabla `tipo_tiro`. |
| `User.php` | Modelo de usuario (si se usa autenticación). |
| `LoginForm.php` | Formulario de inicio de sesión. |
| `ContactForm.php` | Formulario de contacto. |

### 4.8 Carpeta `views/`

#### `views/layouts/`

| Archivo | Descripción |
|---|---|
| `main.php` | Layout principal: carga los assets, selecciona fondo aleatorio, barra de navegación superior con menús desplegables, contenedor de módulos y favicon dinámico. |

#### `views/site/`

| Archivo | Descripción |
|---|---|
| `index.php` | Página de inicio con accesos rápidos a los módulos. |
| `about.php` | Página "Acerca de": información del proyecto, herramientas y integrantes. |
| `contact.php` | Página de contacto. |

#### `views/equipo/`

| Archivo | Descripción |
|---|---|
| `_form.php` | Formulario reutilizable para crear/editar equipos. |
| `create.php` | Vista de alta de equipo. |
| `update.php` | Vista de edición de equipo. |
| `index.php` | Listado de equipos (GridView). |
| `view.php` | Detalle de un equipo. |

#### `views/jugador/`

| Archivo | Descripción |
|---|---|
| `_form.php` | Formulario reutilizable para crear/editar jugadores. |
| `create.php` | Vista de alta de jugador. |
| `update.php` | Vista de edición de jugador. |
| `index.php` | Listado de jugadores (GridView). |
| `view.php` | Detalle de un jugador. |

#### `views/puntuacion/`

| Archivo | Descripción |
|---|---|
| `index.php` | Listado de puntuaciones registradas. |
| `create.php` | Formulario para registrar tiros/puntos por jornada. |

#### `views/reportes/`

| Archivo | Descripción |
|---|---|
| `general.php` | Lista general de jugadores agrupados por equipo. |
| `por-equipo.php` | Jugadores por equipo ordenados por apellidos. |
| `maximos-anotadores.php` | Tabla de posiciones por puntos (mayor a menor). |
| `perfil.php` | Ficha individual del jugador con sus estadísticas. |

### 4.9 Carpeta `web/`

| Ruta | Descripción |
|---|---|
| `index.php` | Punto de entrada de la aplicación web. |
| `.htaccess` | Reglas de reescritura para URLs limpias en Apache. |
| `css/site.css` | Estilos personalizados: fondos, transparencia de módulos, menús desplegables, tablas. |
| `assets/` | Carpeta destino de los assets públicos que Yii publica automáticamente (`AssetManager`). Se mantiene en el repositorio con `.gitkeep` y se llena en el primer arranque. |
| `uploads/logos/` | Logos de equipos subidos. |
| `uploads/fotos/` | Fotografías de jugadores subidas. |
| `uploads/fondos/` | Imágenes de fondo aleatorias por página. |
| `uploads/icono/` | Imagen usada como favicon en la pestaña del navegador (se toma automáticamente). |

---

## 5. Notas importantes

- Si el fondo o las imágenes no se ven, verificar permisos y que la carpeta `web/uploads/` exista.
- Si la base de datos falla, confirmar que MySQL esté iniciado y que `config/db.php` tenga las credenciales correctas.
- Los datos iniciales (**6 equipos, 30 jugadores, 3 tipos de tiro y 77 puntuaciones**) los carga el seeder al ejecutar `php yii migrate`. Para regenerarlos: `php yii migrate/down --all --interactive=0` y luego `php yii migrate --interactive=0`.
- `composer.lock` está versionado: `composer install` instala versiones exactas y reproducibles en cualquier máquina.
- La página "Acerca de" contiene la información del proyecto, herramientas y los integrantes del grupo.