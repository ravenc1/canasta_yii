<?php
use yii\helpers\Html;

$this->title = $model->nombres . ' ' . $model->apellidos;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => ['confirm' => '¿Eliminar jugador?', 'method' => 'post'],
    ]) ?>
    <?= Html::a('Ver perfil', ['/reportes/perfil', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
</p>
<table class="table table-bordered">
    <tr><th>ID</th><td><?= $model->id ?></td></tr>
    <tr><th>Nombres</th><td><?= Html::encode($model->nombres) ?></td></tr>
    <tr><th>Apellidos</th><td><?= Html::encode($model->apellidos) ?></td></tr>
    <tr><th>Fecha de Nacimiento</th><td><?= $model->fecha_nacimiento ?></td></tr>
    <tr><th>Equipo</th><td><?= $model->equipo ? Html::encode($model->equipo->nombre) : '-' ?></td></tr>
    <tr><th>Fotografía</th><td><?= Html::img(\app\helpers\ImagenHelper::src($model->fotografia), ['style' => 'max-width:150px']) ?></td></tr>
    <tr><th>Registro</th><td><?= $model->created_at ?></td></tr>
</table>