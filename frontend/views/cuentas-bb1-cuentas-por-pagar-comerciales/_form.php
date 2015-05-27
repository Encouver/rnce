<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb1CuentasPorPagarComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-bb1-cuentas-por-pagar-comerciales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'proveedor_id')->textInput() ?>

    <?= $form->field($model, 'cantidad_factura')->textInput() ?>

    <?= $form->field($model, 'saldo_al_cierre')->textInput() ?>

    <?= $form->field($model, 'intereses_actividad_e')->textInput() ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

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
