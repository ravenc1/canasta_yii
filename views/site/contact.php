<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Contacto';
?>
<h1><?= Html::encode($this->title) ?></h1>
<?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
    <div class="alert alert-success">Gracias. Te responderemos pronto.</div>
<?php endif; ?>
<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
<div class="form-group">
    <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>