<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancosContratistasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'banco_id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'num_cuenta') ?>

    <?= $form->field($model, 'tipo_moneda') ?>

    <?php // echo $form->field($model, 'tipo_cuenta') ?>

    <?php // echo $form->field($model, 'estatus_cuenta') ?>

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
