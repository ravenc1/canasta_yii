<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Jugadores';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Nuevo Jugador', ['create'], ['class' => 'btn btn-success']) ?></p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'attribute' => 'fotografia',
            'format' => 'raw',
            'value' => function ($m) {
                return Html::img(\app\helpers\ImagenHelper::src($m->fotografia), ['style' => 'width:50px;height:50px;object-fit:cover;border-radius:50%']);
            },
        ],
        'nombres',
        'apellidos',
        'fecha_nacimiento',
        [
            'attribute' => 'equipo_id',
            'label' => 'Equipo',
            'value' => function ($m) {
                return $m->equipo ? $m->equipo->nombre : '-';
            },
        ],
        'created_at',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ],
]) ?>