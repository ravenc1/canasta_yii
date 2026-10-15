<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Equipo;

/* @var $model app\models\Jugador */
/* @var $form ActiveForm */

$equipos = \yii\helpers\ArrayHelper::map(Equipo::find()->all(), 'id', 'nombre');
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'equipo_id')->dropDownList($equipos, ['prompt' => 'Selecciona un equipo']) ?>

<?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>
<?= $form->field($model, 'fecha_nacimiento')->input('date') ?>

<?php if (!$model->isNewRecord && $model->fotografia): ?>
    <div class="mb-2">
        <?= Html::img(\app\helpers\ImagenHelper::src($model->fotografia), ['style' => 'max-width:120px']) ?>
    </div>
<?php endif; ?>

<?= $form->field($model, 'fotoFile')->fileInput() ?>
<?= $form->field($model, 'fotografia')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>