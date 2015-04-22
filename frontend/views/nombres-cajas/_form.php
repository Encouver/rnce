<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\NombresCajas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="nombres-cajas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255]) ?>

    <?php
        /*
        <?= $form->field($model, 'contratistas_id')->textInput() ?>

        <?= $form->field($model, 'sys_status')->checkbox() ?>

        <?= $form->field($model, 'sys_creado_el')->textInput() ?>

        <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

        <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>
        */
    ?>

    <?= $form->field($model, 'tipo_caja')->dropDownList([ 'Nacional' => 'Nacional', 'Extranjera' => 'Extranjera', ], ['prompt' => 'Seleccione el tipo de caja']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
