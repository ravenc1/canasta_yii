<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Equipos';
?>
<h1><?= Html::encode($this->title) ?></h1>
<p><?= Html::a('Nuevo Equipo', ['create'], ['class' => 'btn btn-success']) ?></p>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        [
            'attribute' => 'logo',
            'format' => 'raw',
            'value' => function ($m) {
                return Html::img(\app\helpers\ImagenHelper::src($m->logo), ['style' => 'width:60px;height:60px;object-fit:contain']);
            },
        ],
        'nombre',
        'created_at',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ],
]) ?>