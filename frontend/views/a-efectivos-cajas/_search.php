<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AEfectivosCajasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aefectivos-cajas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_caja_id') ?>

    <?= $form->field($model, 'saldo_cierre_ae') ?>

    <?= $form->field($model, 'tipo_moneda_id') ?>

    <?= $form->field($model, 'monto_me') ?>

    <?php // echo $form->field($model, 'tipo_cambio_cierre') ?>

    <?php // echo $form->field($model, 'nacional')->checkbox() ?>

    <?php // echo $form->field($model, 'total_id') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
