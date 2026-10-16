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

## 2. Entorno de desarrollo local (XAMPP)

Esta sección corresponde al **desarrollo y las pruebas locales** en una máquina con **XAMPP** (Apache + MySQL + PHP). Aquí sí se usa **Composer**, el script `yii` y las **migraciones**. Copia y pega los comandos en tu terminal (**PowerShell/CMD** en Windows, **bash** en Linux/macOS).

> **Flujo del proyecto:** **(1)** desarrollo y pruebas locales (esta sección y [`PRUEBAS.md`](PRUEBAS.md)) → **(2)** publicación en el hosting (sección 3). Composer, `yii` y las migraciones **solo se usan en local**; el servidor de producción no los necesita.

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

### 2.8 Pruebas funcionales locales

Antes de publicar, la aplicación se probó de forma **manual y funcional** en el entorno local (XAMPP). Los **45 casos de prueba** (módulos de equipos, jugadores, puntuaciones, reportes, interfaz e integridad de IDs) están documentados en el archivo [`PRUEBAS.md`](PRUEBAS.md).

### 2.9 Resumen: clonación completa en un solo bloque

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

### 2.10 Solución de problemas frecuentes

| Problema | Causa / Solución |
|---|---|
| `InvalidConfigException: The directory does not exist: .../web/assets` | Falta la carpeta `web/assets/`. Está versionada mediante `.gitkeep`, así que con un clon completo debería existir; si la borraste, recréala vacía. |
| `Fatal error: Failed opening required '.../config/db.php'` | Falta `config/db.php`; ya viene en el repositorio. Asegúrate de clonar/actualizar completo. |
| `SQLSTATE[HY000] [2002] Connection refused` | MySQL/MariaDB no está iniciado. Enciéndelo (XAMPP) e intenta de nuevo. |
| `Unknown database 'lacanasta_db'` | No creaste la base de datos. Repite el paso **2.4**. |
| `Class 'yii\...' not found` | No se instalaron las dependencias. Ejecuta `composer install`. |
| El puerto 8080 está ocupado | Usa `php yii serve --port=8081`. |
| No se ven logos, fotos ni fondos | Verifica que exista `web/uploads/` con sus imágenes (vienen versionadas en el repo). |

---

## 3. Publicación en producción (InfinityFree)

Una vez que la aplicación funciona y fue probada **localmente** (sección 2 y `PRUEBAS.md`), se publicó en un hosting gratuito **InfinityFree**, con el dominio:

🔗 **https://lacanastayii.gt.tc/**

> **Restricciones del servidor (definen el despliegue):**
> - **No hay SSH ni terminal:** no se puede ejecutar `composer` ni `php yii migrate`.
> - **El directorio raíz es siempre `htdocs`** y no se puede cambiar.
>
> Por eso, en el servidor: `vendor/` se sube ya construida, los datos se importan por **phpMyAdmin** y un **`.htaccess`** en la raíz redirige todo hacia `web/` (el directorio público real de Yii).

### 3.1 Prerrequisitos

- Cuenta gratuita en InfinityFree — <https://dash.infinityfree.com/register>
- Un dominio o subdominio (en este proyecto, `lacanastayii.gt.tc`).
- Un cliente FTP (se recomienda **FileZilla**).

### 3.2 Crear la base de datos en el panel

1. En el panel de control, abrir **MySQL Databases** y crear una base de datos.
2. Anotar los cuatro datos de conexión: **host** (`sqlXXX.infinityfree.com`), **nombre**, **usuario** y **contraseña** (con prefijo `if0_`).

### 3.3 Exportar los datos locales

Genera un respaldo `.sql` desde la base de datos local (XAMPP):

```bash
C:\xampp\mysql\bin\mysqldump.exe -u root --no-create-db --default-character-set=utf8mb4 lacanasta_db > lacanasta_db.sql
```

> En el repositorio se incluye un respaldo listo para importar: **`deploy/lacanasta_db.sql`**.

### 3.4 Importar los datos en el servidor

1. Abrir **phpMyAdmin** desde el panel de InfinityFree.
2. Seleccionar la base creada → pestaña **Import** → subir `lacanasta_db.sql`.
3. Verificar: **6 equipos, 30 jugadores, 3 tipos de tiro y 77 puntuaciones**.

### 3.5 Configurar la conexión

Editar `config/db.php` **en el servidor** con los datos reales del hosting (host, nombre, usuario y contraseña).

```php
return [
    'class'    => 'yii\db\Connection',
    'dsn'      => 'mysql:host=sqlXXX.infinityfree.com;dbname=if0_XXXXXXX_lacanasta;charset=utf8mb4',
    'username' => 'if0_XXXXXXX',
    'password' => 'TU_PASSWORD',
    'charset'  => 'utf8mb4',
];
```

> **Buena práctica:** no subir estas credenciales al repositorio público; cambiarlas solo en el servidor.

### 3.6 Subir los archivos

Sube **todo el contenido del proyecto dentro de `htdocs/`**, de modo que quede `htdocs/web/`, `htdocs/config/`, `htdocs/vendor/`, `htdocs/runtime/`, `htdocs/.htaccess`, etc.

- Método recomendado: **FTP con FileZilla**, por la cantidad de archivos de `vendor/`.
- Asegúrate de subir `vendor/` (no viene en Git) y de que existan `runtime/` y `web/assets/`.

### 3.7 Archivo `.htaccess` de la raíz

```apache
RewriteEngine on
RewriteRule ^(.*)$ web/$1 [L]
```

### 3.8 Configuración de producción

- En `web/index.php`: dejar `YII_DEBUG = false` y `YII_ENV = 'prod'`.
- Activar el **SSL gratuito** (Free SSL Certificates) para servir la app por HTTPS.

### 3.9 Verificación de la publicación

| Comprobación | Resultado |
|---|---|
| Página de inicio, HTTPS, CSS/assets e imágenes | OK |
| Módulos de equipos, jugadores y puntuaciones con datos | OK |
| Reportes (general, por equipo, máximos anotadores y perfil) | OK |

---

## 4. Cómo se hizo el proyecto (pasos generales)

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

## 5. Estructura del proyecto y archivos principales

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

### 5.1 Carpeta `assets/`

| Archivo | Descripción |
|---|---|
| `AppAsset.php` | Declara el bundle de recursos de la aplicación. Registra `web/css/site.css` y depende de `YiiAsset`, `BootstrapAsset` y `BootstrapPluginAsset` (Bootstrap 5). |

### 5.2 Carpeta `commands/`

| Archivo | Descripción |
|---|---|
| `SeedController.php` | Comando de consola auxiliar (si se usa para sembrar datos). |

### 5.3 Carpeta `config/`

| Archivo | Descripción |
|---|---|
| `web.php` | Configuración principal de la aplicación web: rutas, componentes (db, request, session, user, etc.) y parámetros. |
| `console.php` | Configuración para ejecutar comandos de consola (`php yii ...`). |
| `db.php` | Credenciales y DSN de conexión a MySQL/MariaDB. |
| `params.php` | Parámetros globales de la aplicación. |

### 5.4 Carpeta `controllers/`

| Archivo | Descripción |
|---|---|
| `SiteController.php` | Controlador del sitio público: inicio (`index`), acerca de (`about`), contacto (`contact`) e inicio de sesión. |
| `EquipoController.php` | CRUD de equipos: listado, creación, edición, detalle y eliminación. |
| `JugadorController.php` | CRUD de jugadores, incluyendo relación con el equipo. |
| `PuntuacionController.php` | Listado y registro de puntuaciones/tiros por jornada. |
| `ReportesController.php` | Reportes: lista general, jugadores por equipo, máximos anotadores y perfil individual. |

### 5.5 Carpeta `helpers/`

| Archivo | Descripción |
|---|---|
| `ImagenHelper.php` | Helper para generar la URL de logos y fotografías subidas en `web/uploads/`. |

### 5.6 Carpeta `migrations/`

| Archivo | Descripción |
|---|---|
| `m241013_000001_create_equipo_table.php` | Crea la tabla `equipo` (id, nombre, logo, fecha de registro). |
| `m241013_000002_create_jugador_table.php` | Crea la tabla `jugador` (datos personales, fotografía y FK a `equipo`). |
| `m241013_000003_create_tipo_tiro_table.php` | Crea la tabla `tipo_tiro` (catálogo de tipos de tiro). |
| `m241013_000004_create_puntuacion_table.php` | Crea la tabla `puntuacion` (jugador, tipo de tiro, cantidad, jornada, fecha). |
| `m241013_000005_seed_data.php` | Inserta los datos iniciales (6 equipos, 30 jugadores, 3 tipos de tiro y 77 puntuaciones). |

### 5.7 Carpeta `models/`

| Archivo | Descripción |
|---|---|
| `Equipo.php` | Modelo ActiveRecord de la tabla `equipo`. |
| `Jugador.php` | Modelo ActiveRecord de la tabla `jugador`, con relación a `Equipo`. |
| `Puntuacion.php` | Modelo ActiveRecord de la tabla `puntuacion`. |
| `TipoTiro.php` | Modelo ActiveRecord de la tabla `tipo_tiro`. |
| `User.php` | Modelo de usuario (si se usa autenticación). |
| `LoginForm.php` | Formulario de inicio de sesión. |
| `ContactForm.php` | Formulario de contacto. |

### 5.8 Carpeta `views/`

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

### 5.9 Carpeta `web/`

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

## 6. Notas importantes

- La aplicación está **publicada en producción** en InfinityFree (sección 3). El informe técnico completo está en `docs/Manual_Tecnico_La_Canasta.pdf`.
- **`PRUEBAS.md`** documenta las pruebas funcionales realizadas en el **entorno local, antes** de la publicación.
- El proyecto está organizado en dos entornos: **local** (XAMPP + Composer + migraciones) y **producción** (InfinityFree + `vendor/` subida + datos importados por phpMyAdmin).
- Si el fondo o las imágenes no se ven, verificar permisos y que la carpeta `web/uploads/` exista.
- Si la base de datos falla, confirmar que MySQL esté iniciado y que `config/db.php` tenga las credenciales correctas.
- Los datos iniciales (**6 equipos, 30 jugadores, 3 tipos de tiro y 77 puntuaciones**) los carga el seeder al ejecutar `php yii migrate`. Para regenerarlos: `php yii migrate/down --all --interactive=0` y luego `php yii migrate --interactive=0`.
- `composer.lock` está versionado: `composer install` instala versiones exactas y reproducibles en cualquier máquina.
- La página "Acerca de" contiene la información del proyecto, herramientas y los integrantes del grupo.