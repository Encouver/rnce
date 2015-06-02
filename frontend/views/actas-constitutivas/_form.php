<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ActasConstitutivas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actas-constitutivas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

    <?= $form->field($model, 'denominacion_comercial_id')->textInput() ?>

    <?= $form->field($model, 'duracion_empresa_id')->textInput() ?>

    <?= $form->field($model, 'objeto_social_id')->textInput() ?>

    <?= $form->field($model, 'razon_social_id')->textInput() ?>

    <?= $form->field($model, 'cierre_ejercicio_id')->textInput() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'domicilio_fiscal_id')->textInput() ?>

    <?= $form->field($model, 'domicilio_principal_id')->textInput() ?>

    <?= $form->field($model, 'acciones')->checkbox() ?>

    <?= $form->field($model, 'certificados')->checkbox() ?>

    <?= $form->field($model, 'suplementarios')->checkbox() ?>

    <?= $form->field($model, 'capital_suscrito')->textInput() ?>

    <?= $form->field($model, 'capital_pagado')->textInput() ?>

    <?= $form->field($model, 'actual')->checkbox() ?>

    <?= $form->field($model, 'modificacion_acta_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
