<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Puntuaciones';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Registrar Tiros', ['create'], ['class' => 'btn btn-success']) ?></p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'attribute' => 'jugador_id',
            'label' => 'Jugador',
            'value' => function ($m) {
                return $m->jugador ? $m->jugador->nombres . ' ' . $m->jugador->apellidos : '-';
            },
        ],
        'jornada',
        [
            'attribute' => 'tipo_tiro_id',
            'label' => 'Tipo de Tiro',
            'value' => function ($m) {
                return $m->tipoTiro ? $m->tipoTiro->nombre : '-';
            },
        ],
        'puntos',
        'fecha_registro',
        [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ],
]) ?>