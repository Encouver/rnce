<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasI2DeclaracionIslrSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i2-declaracion-islr-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_declaracion_id') ?>

    <?= $form->field($model, 'numero_planilla') ?>

    <?= $form->field($model, 'num_certificado_elec') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'total_ingresos') ?>

    <?php // echo $form->field($model, 'total_egresos') ?>

    <?php // echo $form->field($model, 'impuesto_determinado') ?>

    <?php // echo $form->field($model, 'impuesto_pagado') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
