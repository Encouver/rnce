<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-b2-otras-cuentas-por-cobrar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'criterio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'origen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'garantia')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'nocorriente')->checkbox() ?>

    <?= $form->field($model, 'plazo_contrato_c')->textInput() ?>

    <?= $form->field($model, 'saldo_neto_c')->textInput() ?>

    <?= $form->field($model, 'plazo_contrato_nc')->textInput() ?>

    <?= $form->field($model, 'saldo_neto_nc')->textInput() ?>

    <?= $form->field($model, 'criterio_id')->textInput() ?>

    <?= $form->field($model, 'otro_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
