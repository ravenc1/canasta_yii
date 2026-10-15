<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Jugadores por Equipo';
?>
<h1><?= Html::encode($this->title) ?></h1>

<form method="get" class="row g-3 mb-4">
    <div class="col-auto">
        <select name="equipo_id" class="form-select">
            <option value="">-- Selecciona un equipo --</option>
            <?php foreach ($equipos as $e): ?>
                <option value="<?= $e->id ?>" <?= ($equipo_id == $e->id) ? 'selected' : '' ?>>
                    <?= Html::encode($e->nombre) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Filtrar</button>
    </div>
</form>

<?php if ($equipo_id && !empty($jugadores)): ?>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Fecha de Nacimiento</th>
                <th>Equipo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($jugadores as $j): ?>
                <tr>
                    <td><?= Html::img(\app\helpers\ImagenHelper::src($j->fotografia), ['style' => 'width:45px;height:45px;object-fit:cover;border-radius:50%']) ?></td>
                    <td><?= Html::encode($j->nombres) ?></td>
                    <td><?= Html::encode($j->apellidos) ?></td>
                    <td><?= $j->fecha_nacimiento ?></td>
                    <td><?= $j->equipo ? Html::encode($j->equipo->nombre) : '-' ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php elseif ($equipo_id): ?>
    <div class="alert alert-warning">El equipo no tiene jugadores registrados.</div>
<?php endif; ?>