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

## 2. Cómo clonar y ejecutar el proyecto (para los compañeros)

### 2.1 Requisitos previos

- **Git** instalado.
- **PHP 8.x**.
- **Composer**.
- **MySQL / MariaDB** (se recomienda XAMPP).
- Navegador web moderno.

### 2.2 Clonar el repositorio desde GitHub

```bash
git clone https://github.com/USUARIO/canasta_yii.git
cd canasta_yii
```

> Reemplazar `https://github.com/USUARIO/canasta_yii.git` por la URL real del repositorio.

### 2.3 Instalar dependencias

```bash
composer install
```

Esto descarga Yii 2, bootstrap5, las librerías de depuración y el resto de dependencias definidas en `composer.json`.

### 2.4 Configurar la base de datos

1. Iniciar MySQL/MariaDB (desde XAMPP o el servicio correspondiente).
2. Crear la base de datos:

```sql
CREATE DATABASE lacanasta_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

3. Verificar/editar `config/db.php` (por defecto usa `localhost`, usuario `root` y contraseña vacía, típico de XAMPP):

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=lacanasta_db',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
```

### 2.5 Ejecutar las migraciones

Esto crea las tablas (`equipo`, `jugador`, `tipo_tiro`, `puntuacion`) e inserta los datos de prueba:

```bash
php yii migrate --interactive=0
```

Incluye un seeder con 4 equipos, 12 jugadores, catálogo de tipos de tiro y ~30 registros de puntuación.

### 2.6 Levantar el servidor de desarrollo

Opción A (servidor embebido de Yii):

```bash
php yii serve
```

Abrir en el navegador: `http://localhost:8080/`

Opción B (XAMPP):

1. Copiar/clonar el proyecto dentro de `C:\xampp\htdocs\canasta_yii`.
2. Acceder a: `http://localhost/canasta_yii/web/`

> En el primer arranque asegurarse de que MySQL esté encendido, de lo contrario los módulos que consultan la base de datos mostrarán error de conexión.

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
| `m241013_000005_seed_data.php` | Inserta datos de prueba (4 equipos, 12 jugadores, tipos de tiro y ~30 puntuaciones). |

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
| `uploads/logos/` | Logos de equipos subidos. |
| `uploads/fotos/` | Fotografías de jugadores subidas. |
| `uploads/fondos/` | Imágenes de fondo aleatorias por página. |
| `uploads/icono/` | Imagen usada como favicon en la pestaña del navegador (se toma automáticamente). |

---

## 5. Notas importantes

- Si el fondo o las imágenes no se ven, verificar permisos y que la carpeta `web/uploads/` exista.
- Si la base de datos falla, confirmar que MySQL esté iniciado y que `config/db.php` tenga las credenciales correctas.
- La página "Acerca de" contiene la información del proyecto, herramientas y los integrantes del grupo.