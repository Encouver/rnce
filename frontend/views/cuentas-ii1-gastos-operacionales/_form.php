<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi1GastosOperacionales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-ii1-gastos-operacionales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_gasto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ventas_hist')->textInput() ?>

    <?= $form->field($model, 'ventas_ajustado')->textInput() ?>

    <?= $form->field($model, 'admin_hist')->textInput() ?>

    <?= $form->field($model, 'admin_ajustado')->textInput() ?>

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
