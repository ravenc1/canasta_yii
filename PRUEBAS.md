# PRUEBAS - Sistema "La Canasta"

Documento de pruebas funcionales del sistema web **La Canasta - Torneo Navideño de Básquetbol**, desarrollado con **Yii 2** y **PHP 8**. Resume qué se probó, qué mejoras se aplicaron y qué errores se corrigieron.

> **Alcance temporal:** todas las pruebas aquí documentadas se ejecutaron en el **entorno local de desarrollo (XAMPP / servidor embebido de Yii)**, **antes** de publicar la aplicación en producción. La publicación posterior en InfinityFree se describe en el `README.md` (sección 3) y en el `docs/Manual_Tecnico_La_Canasta.pdf`.

| Dato | Valor |
|---|---|
| Proyecto | La Canasta - Torneo Navideño de Básquetbol |
| Framework | Yii 2 Basic Template (PHP 8) |
| Tipo de prueba | Manual, funcional (caja negra) |
| Casos ejecutados | 45 (EQ, JG, PT, RP, UI, RN) |
| Resultado global | 45/45 correctos |

---

## 1. Objetivo

Verificar que los módulos de **equipos, jugadores, puntuaciones y reportes** funcionen de extremo a extremo, validando:

- Altas, ediciones, consultas y eliminaciones (CRUD).
- Validaciones de formularios y **carga de archivos** (logo/fotografía).
- Cálculo de puntos según el tipo de tiro.
- Generación de reportes estadísticos y navegación entre ellos.
- **Integridad de datos**: renumeración de IDs y borrado en cascada.

## 2. Alcance

Módulos accesibles desde la interfaz web y sus rutas principales:

| Módulo | Rutas probadas | Qué cubre |
|---|---|---|
| Equipos | `/equipo/index, create, view, update, delete` | CRUD + logo |
| Jugadores | `/jugador/index, create, view, update, delete` | CRUD + foto + equipo |
| Puntuaciones | `/puntuacion/index, create, delete` | Registro de tiros por jornada |
| Reportes | `/reportes/general, por-equipo, maximos-anotadores, perfil` | Estadísticas |
| Navegación/UI | layout `main.php` | Menú, fondos, favicon, botones |

**Fuera de alcance:** autenticación de usuarios y envío de correo (módulos heredados del template, no usados por el torneo).

## 3. Entorno de pruebas

| Elemento | Detalle |
|---|---|
| Sistema operativo | Windows 10/11 |
| Servidor | XAMPP (Apache/MySQL) o embebido de Yii (`php yii serve`) |
| PHP | 8.x |
| Base de datos | MySQL / MariaDB (`lacanasta_db`, utf8mb4) |
| Navegador | Chrome / Edge (versiones recientes) |
| URL base | `http://localhost:8080/` o `http://localhost/canasta_yii/web/` |
| Datos iniciales | Migración semilla: 6 equipos, 30 jugadores, 3 tipos de tiro, 77 puntuaciones |

## 4. Metodología

Pruebas **manuales de caja negra**, ejecutando cada caso sobre la interfaz y observando el resultado. Cada caso se documenta con:

- **ID**: identificador único (`MÓDULO-nn`).
- **Descripción**: acción ejecutada.
- **Resultado esperado**: comportamiento correcto.
- **Resultado obtenido**: observación real.
- **Estado**: `OK` (coincide) o `FALLA` (no coincide). Todos los casos quedaron en `OK`.

---

## 5. Casos de prueba

### 5.1 Módulo Equipos

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| EQ-01 | Listar equipos (`/equipo/index`) | GridView con ID, logo, nombre y fecha | Tabla visible con 6 equipos | OK |
| EQ-02 | Crear equipo válido con logo | Guarda, asigna `created_at` y redirige a `view` | Equipo creado y detalle mostrado | OK |
| EQ-03 | Crear sin nombre | Error "Nombre del Equipo no puede estar vacío" | Validación mostrada | OK |
| EQ-04 | Crear sin logo (escenario `create`) | Error "El logo no puede estar vacío." | Mensaje mostrado | OK |
| EQ-05 | Logo con extensión no permitida (ej. `.txt`) | Regla `file` rechaza el archivo | Archivo rechazado | OK |
| EQ-06 | Logo mayor a 2 MB | Regla `maxSize` (2·1024·1024) rechaza | Archivo rechazado | OK |
| EQ-07 | Editar nombre y logo | Actualiza y redirige a `view` | Datos y logo actualizados | OK |
| EQ-08 | Eliminar equipo | Elimina, borra jugadores/puntuaciones en cascada y renumera | Consistente y consecutivo | OK |
| EQ-09 | Ver detalle (`/equipo/view`) | Datos + botones Actualizar/Eliminar/Regresar | Detalle completo | OK |
| EQ-10 | Visualizar logo guardado en `web/uploads/logos/` | Imagen visible (o placeholder si falta) | Imagen visible | OK |

### 5.2 Módulo Jugadores

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| JG-01 | Listar jugadores (`/jugador/index`) | GridView con foto, nombre, edad y equipo | Lista visible (join con `equipo`) | OK |
| JG-02 | Crear jugador válido con foto | Guarda relación con equipo y redirige a `view` | Jugador creado | OK |
| JG-03 | Crear sin foto (escenario `create`) | Error "La fotografía no puede estar vacía." | Mensaje mostrado | OK |
| JG-04 | Crear sin nombres/apellidos/fecha | Errores `required` | Mensajes mostrados | OK |
| JG-05 | Asignar equipo por `dropDownList` | Se guarda `equipo_id` válido | Relación guardada | OK |
| JG-06 | Editar datos y foto | Actualiza y redirige a `view` | Actualización correcta | OK |
| JG-07 | Eliminar jugador | Elimina y renumera jugadores y puntuaciones | Eliminado, IDs consecutivos | OK |
| JG-08 | Botón "Ver perfil" en detalle | Redirige a `/reportes/perfil` | Perfil mostrado | OK |
| JG-09 | Botón "Regresar" en detalle | Vuelve al listado de jugadores | Navegación correcta | OK |
| JG-10 | Foto guardada en `web/uploads/fotos/` | Imagen visible en listado/detalle | Imagen visible | OK |

### 5.3 Módulo Puntuaciones

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| PT-01 | Listar puntuaciones (`/puntuacion/index`) | Tabla con jugador, jornada, tipo, puntos y fecha | Lista visible (orden por fecha) | OK |
| PT-02 | Registrar puntuación válida | Guarda y redirige al listado | Registro creado | OK |
| PT-03 | Registrar con campos vacíos | Errores `required` (jugador, jornada, tipo) | Mensajes mostrados | OK |
| PT-04 | Verificar cálculo de puntos | `puntos = valor del tipo de tiro` si se deja vacío | Cálculo automático correcto | OK |
| PT-05 | Eliminar puntuación | Elimina y renumera IDs | Eliminado correctamente | OK |
| PT-06 | Consistencia con jugador/equipo | La puntuación refleja al jugador correcto | Consistente | OK |

### 5.4 Módulo Reportes

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| RP-01 | Lista general (`/reportes/general`) | Jugadores agrupados por equipo en tarjetas | Lista visible | OK |
| RP-02 | Botón "Ver" en lista general | Abre perfil con `from=general` | Perfil abierto | OK |
| RP-03 | Jugadores por equipo (`/reportes/por-equipo`) | Filtro por equipo, ordenado por apellidos | Filtro y orden correctos | OK |
| RP-04 | Máximos anotadores (`/reportes/maximos-anotadores`) | Puntos por jugador (`SUM`), mayor a menor | Orden correcto | OK |
| RP-05 | Botón "Ver perfil" en máximos | Abre perfil con `from=maximos` | Perfil abierto | OK |
| RP-06 | Perfil individual (`/reportes/perfil`) | Datos, resumen por jornada, historial y total | Perfil completo | OK |
| RP-07 | "Volver" desde perfil (origen general) | Regresa a lista general | Navegación correcta | OK |
| RP-08 | "Volver" desde perfil (origen máximos) | Regresa a máximos anotadores | Navegación correcta | OK |
| RP-09 | Perfil de jugador inexistente | Lanza `NotFoundHttpException` (error controlado) | Comportamiento esperado | OK |

### 5.5 Navegación e interfaz

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| UI-01 | Menú superior con desplegables | Acceso a todos los módulos | Menú funcional | OK |
| UI-02 | Fondo aleatorio por página | Se carga un fondo distinto de `uploads/fondos/` | Fondo visible | OK |
| UI-03 | Contenedores semitransparentes | No ocultan el fondo (con blur) | Estilo visible | OK |
| UI-04 | Favicon dinámico desde `uploads/icono/` | El ícono aparece en la pestaña | Ícono visible | OK |
| UI-05 | Botones "Regresar/Volver" | Retornan al listado u origen correcto | Navegación correcta | OK |

### 5.6 Renumeración e integridad de IDs

| ID | Descripción | Resultado esperado | Resultado obtenido | Estado |
|---|---|---|---|---|
| RN-01 | Eliminar un equipo | IDs de equipos consecutivos (1..n) | Renumerados | OK |
| RN-02 | Eliminar un jugador | IDs de jugadores consecutivos (1..n) | Renumerados | OK |
| RN-03 | Eliminar una puntuación | IDs de puntuaciones consecutivos (1..n) | Renumerados | OK |
| RN-04 | `AUTO_INCREMENT` tras renumerar | Próximo ID = cantidad + 1 | Valor correcto | OK |
| RN-05 | Borrado en cascada | Sin registros huérfanos (FK `ON DELETE CASCADE`) | Consistente | OK |

---

## 6. Mejoras aplicadas

| Mejora | Detalle | Archivos |
|---|---|---|
| Validación correcta de archivos | El `required` de creación valida `logoFile`/`fotoFile` (no el campo de texto `logo`/`fotografia`) | `models/Equipo.php`, `models/Jugador.php` |
| Restricción de tipo y tamaño | `extensions` (png/jpg/gif/svg/webp) y `maxSize` 2 MB en logos y fotos | `models/Equipo.php`, `models/Jugador.php` |
| Mensajes de error descriptivos | `addError` cuando el archivo no se puede guardar en disco | `controllers/EquipoController.php`, `controllers/JugadorController.php` |
| Renumeración de IDs | `renumberIds()` dentro de transacción + ajuste de `AUTO_INCREMENT` | `models/Equipo.php`, `Jugador.php`, `Puntuacion.php` |
| Integridad referencial | Claves foráneas con `ON DELETE/UPDATE CASCADE` entre equipo-jugador-puntuación | `migrations/m241013_000002`, `m241013_000004` |
| Cálculo automático de puntos | `default` en la regla + `beforeSave` toman el valor del tipo de tiro si se omite | `models/Puntuacion.php`, `controllers/PuntuacionController.php` |
| Navegación parametrizada | El botón "Volver" del perfil usa `from` (`general`/`maximos`) | `controllers/ReportesController.php`, `views/reportes/perfil.php` |
| Botones "Regresar" | Añadidos en los detalles de equipo y jugador | `views/equipo/view.php`, `views/jugador/view.php` |
| Imágenes robustas | `ImagenHelper::src()` devuelve placeholder si el archivo no existe (evita imágenes rotas) | `helpers/ImagenHelper.php` |
| Interfaz personalizada | Fondo aleatorio por página, contenedores semitransparentes con blur, favicon dinámico y menús desplegables Bootstrap 5 | `views/layouts/main.php` |
| URLs amigables y español | `enablePrettyUrl`, `showScriptName=false` y `language=es` | `config/web.php` |

## 7. Errores corregidos

| Incidencia | Causa | Corrección aplicada | Módulo |
|---|---|---|---|
| El logo/foto no se validaba como obligatorio | La regla estaba sobre `logo`/`fotografia` en lugar del archivo subido | Regla `required` sobre `logoFile`/`fotoFile` con escenario `create` | Equipos/Jugadores |
| Mensaje genérico al fallar la carga | No se reportaba el error de guardado del archivo | `addError('logoFile'/'fotoFile', ...)` con mensaje claro | Equipos/Jugadores |
| IDs con huecos tras eliminar | Auto-incremento dejaba valores discontinuos | `renumberIds()` reasigna 1..n y corrige `AUTO_INCREMENT` | Equipos/Jugadores/Puntuaciones |
| Botón "Volver" siempre fijo en el perfil | No distinguía el origen del usuario | Parámetro `from` en el enlace y en el controlador | Reportes |
| Sin botón de regreso en los detalles | Las vistas de detalle no tenían navegación de salida | Botón "Regresar" en `view.php` | Equipos/Jugadores |
| Puntos inconsistentes al registrar tiros | El usuario podía dejar `puntos` vacío o incorrecto | Cálculo automático según tipo de tiro (regla + `beforeSave`) | Puntuaciones |
| Imágenes rotas cuando el archivo no existía | Se enlazaba la ruta aunque el archivo faltara | Verificación en disco y uso de `placeholder.svg` | Helper/Todas las vistas |
| Desplegables ocultos tras el contenido | El contenedor quedaba sobre el menú | `z-index` corregido en navbar y contenedores | Interfaz |
| Las páginas de error devolvían 500 | Faltaba la vista `views/site/error.php` usada por `site/error` | Se creó la vista de error; ahora responde 404/405 correctamente | Todas las rutas |

## 8. Conclusiones

- Los **45 casos** ejecutados resultaron `OK` tras las correcciones aplicadas.
- El CRUD de equipos, jugadores y puntuaciones funciona con validaciones de formulario y de archivos.
- Los reportes generan información consistente y permiten navegar al perfil y regresar al origen correcto.
- La **renumeración de IDs** y el **borrado en cascada** preservan la integridad de los datos.
- El sistema cumple los requisitos funcionales del Torneo Navideño "La Canasta".

---

## 9. Registro de ejecución automatizada

**Fecha:** 15/10/2026 · **Medio:** arnés de peticiones HTTP reales (cURL) con manejo de CSRF y subida de archivos `multipart`, ejecutado contra el servidor embebido de Yii (`http://localhost:8080`) sobre PHP 8.2 y MariaDB 10.4.

| Bloque | Verificaciones | Resultado |
|---|---|---|
| Disponibilidad y navegación (GET + 404) | 16 | OK |
| CRUD de equipos y validaciones | 9 | OK |
| CRUD de jugadores y validaciones | 5 | OK |
| Puntuaciones (registro y cálculo de puntos) | 4 | OK |
| Integridad y renumeración de IDs | 8 | OK |
| Coherencia del reporte de máximos anotadores | 1 | OK |
| Borrado en cascada (no destructivo) | 1 | OK |
| **Total** | **44** | **44/44 OK** |

Las verificaciones automatizadas cubren los mismos módulos que los casos documentados en la sección 5 (su número difiere porque el arnés agrupa algunas comprobaciones, como la disponibilidad de varias rutas en un solo bloque).

**Defecto detectado y corregido:** faltaba `views/site/error.php`; al no existir la vista usada por `site/error`, cualquier error HTTP (404/405) provocaba un segundo fallo y respondía **500** en lugar de la página de error. Se creó la vista y se validó que `/reportes/perfil?id=999999` responde 404 y que el borrado por GET responde 405.

**Estado final de la base tras las pruebas:** 6 equipos, 30 jugadores y 77 puntuaciones; IDs consecutivos 1..n en todas las tablas, `AUTO_INCREMENT = n+1` y sin registros huérfanos.

---

*Documento de pruebas - Proyecto Programación Web (UMG).*
