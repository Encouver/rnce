<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>


    <?php ActiveForm::end(); ?>

</div>
