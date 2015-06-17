<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PolizasContratadasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="polizas-contratadas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'numero_contrato') ?>

    <?= $form->field($model, 'fecha_suscripcion') ?>

    <?= $form->field($model, 'fecha_inicio') ?>

    <?php // echo $form->field($model, 'fecha_finalizacion') ?>

    <?php // echo $form->field($model, 'duracion') ?>

    <?php // echo $form->field($model, 'tipo_poliza') ?>

    <?php // echo $form->field($model, 'monto_asegurado') ?>

    <?php // echo $form->field($model, 'monto_contrato') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'natural_juridica_id') ?>

    <?php // echo $form->field($model, 'bien_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
