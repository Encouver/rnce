<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosFacturasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-facturas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'num_factura') ?>

    <?= $form->field($model, 'proveedor_id') ?>

    <?= $form->field($model, 'fecha_emision') ?>

    <?= $form->field($model, 'imprenta_id') ?>

    <?php // echo $form->field($model, 'fecha_emision_talonario') ?>

    <?php // echo $form->field($model, 'comprador_id') ?>

    <?php // echo $form->field($model, 'base_imponible_gravable') ?>

    <?php // echo $form->field($model, 'exento') ?>

    <?php // echo $form->field($model, 'iva') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'bien_id') ?>

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
