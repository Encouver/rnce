<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasD2OtrosTributosPagSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-d2-otros-tributos-pag-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'otros_tributos_id') ?>

    <?= $form->field($model, 'saldo_pah') ?>

    <?= $form->field($model, 'credito_fiscal') ?>

    <?= $form->field($model, 'monto') ?>

    <?php // echo $form->field($model, 'debito_fiscal') ?>

    <?php // echo $form->field($model, 'debito_fiscal_no') ?>

    <?php // echo $form->field($model, 'importe_pagado') ?>

    <?php // echo $form->field($model, 'saldo_cierre') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
