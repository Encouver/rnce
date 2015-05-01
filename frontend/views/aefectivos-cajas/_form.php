<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\AEfectivosCajas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aefectivos-cajas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_caja_id')->textInput() ?>

    <?= $form->field($model, 'saldo_cierre_ae')->textInput() ?>

    <?= $form->field($model, 'tipo_moneda_id')->textInput() ?>

    <?= $form->field($model, 'monto_me')->textInput() ?>

    <?= $form->field($model, 'tipo_cambio_cierre')->textInput() ?>

    <?= $form->field($model, 'nacional')->checkbox() ?>

    <?= $form->field($model, 'total_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>