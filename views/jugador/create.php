<?php
use yii\helpers\Html;
$this->title = 'Crear Jugador';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?= $this->render('_form', ['model' => $model]) ?>