<?php
use yii\helpers\Html;

$this->title = 'Máximos Anotadores';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p class="text-muted">Posiciones por puntos acumulados (SUM(puntuacion.puntos)), ordenadas de mayor a menor.</p>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Equipo</th>
            <th>Total Puntos</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; foreach ($rows as $r): ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= Html::img(\app\helpers\ImagenHelper::src($r['fotografia']), ['style' => 'width:45px;height:45px;object-fit:cover;border-radius:50%']) ?></td>
                <td><?= Html::encode($r['nombres']) ?></td>
                <td><?= Html::encode($r['apellidos']) ?></td>
                <td><?= Html::encode($r['equipo']) ?></td>
                <td><strong><?= (int)$r['total_puntos'] ?></strong></td>
                <td><?= Html::a('Ver perfil', ['/reportes/perfil', 'id' => $r['jugador_id'], 'from' => 'maximos'], ['class' => 'btn btn-sm btn-info']) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>