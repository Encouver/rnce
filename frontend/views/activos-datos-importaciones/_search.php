<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosDatosImportacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-datos-importaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bien_id') ?>

    <?= $form->field($model, 'num_guia_nac') ?>

    <?= $form->field($model, 'costo_adquisicion') ?>

    <?= $form->field($model, 'gastos_mon_extranjera') ?>

    <?php // echo $form->field($model, 'sys_divisa_id') ?>

    <?php // echo $form->field($model, 'tasa_cambio') ?>

    <?php // echo $form->field($model, 'gastos_imp_nacional') ?>

    <?php // echo $form->field($model, 'otros_costros_imp_instalacion') ?>

    <?php // echo $form->field($model, 'total_costo_adquisicion') ?>

    <?php // echo $form->field($model, 'pais_origen_id') ?>

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
