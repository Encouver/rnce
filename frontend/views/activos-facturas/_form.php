<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosFacturas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-facturas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'num_factura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proveedor_id')->textInput() ?>

    <?= $form->field($model, 'fecha_emision')->textInput() ?>

    <?= $form->field($model, 'imprenta_id')->textInput() ?>

    <?= $form->field($model, 'fecha_emision_talonario')->textInput() ?>

    <?= $form->field($model, 'comprador_id')->textInput() ?>

    <?= $form->field($model, 'base_imponible_gravable')->textInput() ?>

    <?= $form->field($model, 'exento')->textInput() ?>

    <?= $form->field($model, 'iva')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
