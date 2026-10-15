<?php
use yii\helpers\Html;

$this->title = 'Lista General de Jugadores';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p class="text-muted">Todos los jugadores agrupados por equipo.</p>

<?php foreach ($equipos as $equipo): ?>
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <?= Html::img(\app\helpers\ImagenHelper::src($equipo->logo), ['style' => 'width:40px;height:40px;object-fit:contain;margin-right:10px']) ?>
            <strong><?= Html::encode($equipo->nombre) ?></strong>
            <span class="ms-auto badge bg-light text-dark"><?= count($equipo->jugadores) ?> jugadores</span>
        </div>
        <div class="card-body">
            <?php if (empty($equipo->jugadores)): ?>
                <p class="text-muted">Sin jugadores registrados.</p>
            <?php else: ?>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Foto</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($equipo->jugadores as $j): ?>
                            <tr>
                                <td><?= Html::img(\app\helpers\ImagenHelper::src($j->fotografia), ['style' => 'width:45px;height:45px;object-fit:cover;border-radius:50%']) ?></td>
                                <td><?= Html::encode($j->nombres) ?></td>
                                <td><?= Html::encode($j->apellidos) ?></td>
                                <td><?= $j->fecha_nacimiento ?></td>
                                <td>
                                    <?= Html::a('Ver', ['/reportes/perfil', 'id' => $j->id], ['class' => 'btn btn-sm btn-info']) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
<?php endforeach; ?>