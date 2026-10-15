<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $model app\models\Equipo */
/* @var $form ActiveForm */
?>
<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

<?php if (!$model->isNewRecord && $model->logo): ?>
    <div class="mb-2">
        <?= Html::img(\app\helpers\ImagenHelper::src($model->logo), ['style' => 'max-width:120px']) ?>
    </div>
<?php endif; ?>

<?= $form->field($model, 'logoFile')->fileInput() ?>

<?= $form->field($model, 'logo')->hiddenInput()->label(false) ?>

<div class="form-group">
    <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>