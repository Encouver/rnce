<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\ContratistasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'natural_juridica_id') ?>

    <?= $form->field($model, 'estatus_contratista_id') ?>

    <?= $form->field($model, 'sigla') ?>

    <?= $form->field($model, 'principio_contable') ?>

    <?php // echo $form->field($model, 'ppal_caev_id') ?>

    <?php // echo $form->field($model, 'comp1_caev_id') ?>

    <?php // echo $form->field($model, 'comp2_caev_id') ?>

    <?php // echo $form->field($model, 'contacto_id') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'tipo_sector') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
