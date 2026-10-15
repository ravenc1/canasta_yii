<?php

use yii\helpers\Html;

$this->title = 'Inicio';
?>
<div class="site-index">
    <div class="jumbotron text-center p-5 rounded mb-4" style="background-color: rgba(255,255,255,0.22); backdrop-filter: blur(4px);">
        <h1 class="display-5">Grupo 1 - La Canasta</h1>
        <p class="lead">Sistema de Gestión del Torneo Navideño de Básquetbol</p>
        <p>
            <?= Html::a('Equipos', ['/equipo/index'], ['class' => 'btn btn-primary btn-lg m-1']) ?>
            <?= Html::a('Jugadores', ['/jugador/index'], ['class' => 'btn btn-success btn-lg m-1']) ?>
            <?= Html::a('Registrar Tiros', ['/puntuacion/create'], ['class' => 'btn btn-warning btn-lg m-1']) ?>
            <?= Html::a('Reportes', ['/reportes/general'], ['class' => 'btn btn-info btn-lg m-1']) ?>
        </p>
    </div>

    <div class="row text-center">
        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Equipos</h5>
                    <p class="card-text">Administra los equipos del torneo.</p>
                    <?= Html::a('Ir', ['/equipo/index'], ['class' => 'btn btn-outline-primary']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Jugadores</h5>
                    <p class="card-text">Registra y gestiona jugadores.</p>
                    <?= Html::a('Ir', ['/jugador/index'], ['class' => 'btn btn-outline-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Anotaciones</h5>
                    <p class="card-text">Registra puntos por jornada.</p>
                    <?= Html::a('Ir', ['/puntuacion/index'], ['class' => 'btn btn-outline-warning']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">Reportes</h5>
                    <p class="card-text">Consultas y estadísticas.</p>
                    <?= Html::a('Ir', ['/reportes/general'], ['class' => 'btn btn-outline-info']) ?>
                </div>
            </div>
        </div>
    </div>
</div>