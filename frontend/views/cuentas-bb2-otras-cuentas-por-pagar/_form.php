<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb2OtrasCuentasPorPagar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-bb2-otras-cuentas-por-pagar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'criterio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'garantia')->textInput() ?>

    <?= $form->field($model, 'plazo')->textInput() ?>

    <?= $form->field($model, 'saldo_conta_co')->textInput() ?>

    <?= $form->field($model, 'saldo_conta_nc')->textInput() ?>

    <?= $form->field($model, 'intereses')->textInput() ?>

    <?= $form->field($model, 'criterio_id')->textInput() ?>

    <?= $form->field($model, 'otro_nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>

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
