<?php
use yii\helpers\Html;

$this->title = 'Perfil del Jugador';
$model = $model;
?>
<h1><?= Html::encode($model->nombres . ' ' . $model->apellidos) ?></h1>

<div class="row">
    <div class="col-md-4 text-center">
        <?= Html::img(\app\helpers\ImagenHelper::src($model->fotografia), ['class' => 'img-thumbnail', 'style' => 'max-width:220px']) ?>
        <?php if ($model->equipo): ?>
            <div class="mt-3">
                <?= Html::img(\app\helpers\ImagenHelper::src($model->equipo->logo), ['style' => 'width:60px;height:60px;object-fit:contain']) ?>
                <div class="fw-bold"><?= Html::encode($model->equipo->nombre) ?></div>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-8">
        <table class="table table-bordered">
            <tr><th>Nombres</th><td><?= Html::encode($model->nombres) ?></td></tr>
            <tr><th>Apellidos</th><td><?= Html::encode($model->apellidos) ?></td></tr>
            <tr><th>Fecha de Nacimiento</th><td><?= $model->fecha_nacimiento ?></td></tr>
            <tr><th>Total Acumulado</th><td><strong><?= $total ?> puntos</strong></td></tr>
        </table>

        <h4 class="mt-3">Resumen por jornada</h4>
        <table class="table table-sm table-bordered">
            <thead>
                <tr><th>Jornada</th><th>Total</th></tr>
            </thead>
            <tbody>
                <?php foreach ($porJornada as $p): ?>
                    <tr>
                        <td>Jornada <?= $p['jornada'] ?></td>
                        <td><?= (int)$p['total'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($porJornada)): ?>
                    <tr><td colspan="2" class="text-muted">Sin registros.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <h4 class="mt-3">Historial detallado</h4>
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Jornada</th>
                    <th>Tipo de Tiro</th>
                    <th>Puntos</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($historial as $h): ?>
                    <tr>
                        <td><?= $h->fecha_registro ?></td>
                        <td><?= $h->jornada ?></td>
                        <td><?= $h->tipoTiro ? Html::encode($h->tipoTiro->nombre) : '-' ?></td>
                        <td><?= $h->puntos ?></td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($historial)): ?>
                    <tr><td colspan="4" class="text-muted">Sin registros.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<p class="mt-3">
    <?= Html::a('Volver', ['/reportes/maximos-anotadores'], ['class' => 'btn btn-secondary']) ?>
</p>