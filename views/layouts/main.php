<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);

    // Fondo de la página: fondohome.jpg solo en Inicio; el resto usa
    // una imagen aleatoria de web/uploads/fondos/.
    $fondosDir = Yii::getAlias('@webroot') . '/uploads/fondos';
    $fondosUrl = Yii::getAlias('@web') . '/uploads/fondos';
    $fondoActual = null;
    $controller = Yii::$app->controller;
    $route = $controller ? $controller->getRoute() : '';

    $archivos = [];
    if (is_dir($fondosDir)) {
        foreach (scandir($fondosDir) as $archivo) {
            if ($archivo === '.' || $archivo === '..') {
                continue;
            }
            $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            if (!in_array($ext, ['jpg', 'jpeg', 'png', 'webp'], true)) {
                continue;
            }
            if (is_file($fondosDir . '/' . $archivo)) {
                $archivos[] = $archivo;
            }
        }
    }
    if (!empty($archivos)) {
        $fondoActual = $archivos[array_rand($archivos)];
    }

    // Icono para la pestaña del navegador (web/uploads/icono/)
    $iconoDir = Yii::getAlias('@webroot') . '/uploads/icono';
    $iconoUrl = Yii::getAlias('@web') . '/uploads/icono';
    $iconoArchivo = null;
    $iconosPermitidos = ['ico', 'png', 'jpg', 'jpeg', 'svg', 'webp'];
    if (is_dir($iconoDir)) {
        foreach (scandir($iconoDir) as $archivo) {
            if ($archivo === '.' || $archivo === '..') {
                continue;
            }
            $ext = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
            if (!in_array($ext, $iconosPermitidos, true)) {
                continue;
            }
            if (is_file($iconoDir . '/' . $archivo)) {
                $iconoArchivo = $archivo;
                break;
            }
        }
    }

    $this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - La Canasta</title>
    <?php if ($fondoActual): ?>
    <style>
        body {
            background-image: url('<?= $fondosUrl . '/' . rawurlencode($fondoActual) ?>');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }
        /* El contenedor de cada modulo queda transparente para no tapar el fondo */
        .app-container {
            background-color: rgba(255, 255, 255, 0.20);
            border-radius: 14px;
            padding: 22px;
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        /* Evita que los desplegables queden detras del contenido de los modulos */
        .navbar { position: relative; z-index: 1030; }
        .navbar .dropdown-menu { z-index: 1050; }
        .app-container { position: relative; z-index: 1; }

        /* La barra superior no debe heredar fondo blanco del contenedor interno */
        .navbar .container {
            background: transparent !important;
            box-shadow: none !important;
            border-radius: 0 !important;
            backdrop-filter: none !important;
        }
        .navbar .nav-link { color: #f8fafc !important; text-shadow: 0 1px 2px rgba(0,0,0,0.85); }
        .navbar .nav-link:hover { color: #38bdf8 !important; }
        .navbar .dropdown-menu {
            background-color: rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(56, 189, 248, 0.35);
        }
        .navbar .dropdown-item { color: #f8fafc; }
        .navbar .dropdown-item:hover {
            background-color: rgba(56, 189, 248, 0.22);
            color: #ffffff;
        }
    </style>
    <?php endif; ?>
    <?php if ($iconoArchivo): ?>
    <?php
        $iconoMimes = [
            'ico' => 'image/x-icon',
            'png' => 'image/png',
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'svg' => 'image/svg+xml',
            'webp' => 'image/webp',
        ];
        $iconoExt = strtolower(pathinfo($iconoArchivo, PATHINFO_EXTENSION));
        $iconoMime = $iconoMimes[$iconoExt] ?? 'image/png';
    ?>
    <link rel="icon" type="<?= $iconoMime ?>" href="<?= $iconoUrl . '/' . rawurlencode($iconoArchivo) ?>">
    <link rel="shortcut icon" type="<?= $iconoMime ?>" href="<?= $iconoUrl . '/' . rawurlencode($iconoArchivo) ?>">
    <?php endif; ?>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar navbar-expand-lg navbar-dark shadow" style="background-color: rgba(15, 23, 42, 0.88); backdrop-filter: blur(8px);">
    <div class="container">
        <?= Html::a('🏀 La Canasta', ['/site/index'], ['class' => 'navbar-brand fw-bold text-white']) ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><?= Html::a('Inicio', ['/site/index'], ['class' => 'nav-link']) ?></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Equipos</a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Listado', ['/equipo/index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a('Nuevo Equipo', ['/equipo/create'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Jugadores</a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Listado', ['/jugador/index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a('Nuevo Jugador', ['/jugador/create'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Puntuaciones</a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Listado', ['/puntuacion/index'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a('Registrar Tiros', ['/puntuacion/create'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Reportes</a>
                    <ul class="dropdown-menu">
                        <li><?= Html::a('Lista General de Jugadores', ['/reportes/general'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a('Jugadores por Equipo', ['/reportes/por-equipo'], ['class' => 'dropdown-item']) ?></li>
                        <li><?= Html::a('Máximos Anotadores', ['/reportes/maximos-anotadores'], ['class' => 'dropdown-item']) ?></li>
                    </ul>
                </li>
                <li class="nav-item"><?= Html::a('Acerca de', ['/site/about'], ['class' => 'nav-link']) ?></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container app-container mt-4">
    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
    <?php endif; ?>
    <?= $content ?>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    &copy; <?= date('Y') ?> La Canasta - Torneo Navideño de Básquetbol
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>