<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>El error anterior ocurrió mientras el servidor procesaba tu solicitud.</p>
    <p>Si crees que es un error del servidor, por favor contáctanos.</p>

    <p><?= Html::a('Volver al inicio', ['/site/index'], ['class' => 'btn btn-secondary']) ?></p>
</div>
