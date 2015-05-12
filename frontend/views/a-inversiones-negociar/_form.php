<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\AInversionesNegociar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ainversiones-negociar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'fecha_inversion')->textInput() ?>

    <?= $form->field($model, 'fecha_finalizacion')->textInput() ?>

    <?= $form->field($model, 'tasa')->textInput() ?>

    <?= $form->field($model, 'plazo')->textInput() ?>

    <?= $form->field($model, 'costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'valorizacion')->textInput() ?>

    <?= $form->field($model, 'saldo_al_cierre')->textInput() ?>

    <?= $form->field($model, 'intereses_act_eco')->textInput() ?>

    <?= $form->field($model, 'tipo_moneda_id')->textInput() ?>

    <?= $form->field($model, 'monto_moneda_extra')->textInput() ?>

    <?= $form->field($model, 'tipo_cambio_cierre')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'total_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
