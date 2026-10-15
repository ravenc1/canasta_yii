<?php
use yii\helpers\Html;

$this->title = $model->nombre;
?>
<h1><?= Html::encode($this->title) ?></h1>
<p>
    <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => ['confirm' => '¿Eliminar equipo?', 'method' => 'post'],
    ]) ?>
    <?= Html::a('Regresar', ['index'], ['class' => 'btn btn-secondary']) ?>
</p>
<table class="table table-bordered">
    <tr><th>ID</th><td><?= $model->id ?></td></tr>
    <tr><th>Nombre</th><td><?= Html::encode($model->nombre) ?></td></tr>
    <tr><th>Logo</th><td><?= Html::img(\app\helpers\ImagenHelper::src($model->logo), ['style' => 'max-width:150px']) ?></td></tr>
    <tr><th>Registro</th><td><?= $model->created_at ?></td></tr>
</table>