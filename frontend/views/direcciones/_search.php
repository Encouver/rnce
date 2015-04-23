<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modelsDireccionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'zona') ?>

    <?= $form->field($model, 'calle') ?>

    <?= $form->field($model, 'casa') ?>

    <?= $form->field($model, 'nivel') ?>

    <?php // echo $form->field($model, 'numero') ?>

    <?php // echo $form->field($model, 'referencia') ?>

    <?php // echo $form->field($model, 'sys_estado_id') ?>

    <?php // echo $form->field($model, 'sys_municipio_id') ?>

    <?php // echo $form->field($model, 'sys_parroquia_id') ?>

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
