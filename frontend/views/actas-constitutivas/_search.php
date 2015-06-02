<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActasConstitutivasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actas-constitutivas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'documento_registrado_id') ?>

    <?= $form->field($model, 'denominacion_comercial_id') ?>

    <?= $form->field($model, 'duracion_empresa_id') ?>

    <?php // echo $form->field($model, 'objeto_social_id') ?>

    <?php // echo $form->field($model, 'razon_social_id') ?>

    <?php // echo $form->field($model, 'cierre_ejercicio_id') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'domicilio_fiscal_id') ?>

    <?php // echo $form->field($model, 'domicilio_principal_id') ?>

    <?php // echo $form->field($model, 'acciones')->checkbox() ?>

    <?php // echo $form->field($model, 'certificados')->checkbox() ?>

    <?php // echo $form->field($model, 'suplementarios')->checkbox() ?>

    <?php // echo $form->field($model, 'capital_suscrito') ?>

    <?php // echo $form->field($model, 'capital_pagado') ?>

    <?php // echo $form->field($model, 'actual')->checkbox() ?>

    <?php // echo $form->field($model, 'modificacion_acta_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
