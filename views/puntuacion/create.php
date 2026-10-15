<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Jugador;
use app\models\TipoTiro;
use yii\helpers\ArrayHelper;

$this->title = 'Registrar Puntuación';
$jugadores = ArrayHelper::map(Jugador::find()->with('equipo')->all(), 'id', function ($m) {
    return $m->nombres . ' ' . $m->apellidos . ' (' . ($m->equipo ? $m->equipo->nombre : '') . ')';
});
$tipos = ArrayHelper::map(TipoTiro::find()->all(), 'id', 'nombre');
?>
<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'jugador_id')->dropDownList($jugadores, ['prompt' => 'Selecciona un jugador']) ?>
<?= $form->field($model, 'jornada')->input('number', ['min' => 1]) ?>
<?= $form->field($model, 'tipo_tiro_id')->dropDownList($tipos, ['prompt' => 'Selecciona tipo de tiro']) ?>
<?= $form->field($model, 'puntos')->input('number', ['min' => 1, 'placeholder' => 'Se calcula según el tipo de tiro']) ?>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>