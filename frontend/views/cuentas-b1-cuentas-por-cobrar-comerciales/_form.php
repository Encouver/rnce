<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB1CuentasPorCobrarComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-b1-cuentas-por-cobrar-comerciales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'concepto')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'num_fact_contr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'porcentaje')->textInput() ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'nocorriente')->checkbox() ?>

    <?= $form->field($model, 'plazo_contrato_c')->textInput() ?>

    <?= $form->field($model, 'saldo_c')->textInput() ?>

    <?= $form->field($model, 'deterioro_c')->checkbox() ?>

    <?= $form->field($model, 'valor_de_uso_c')->textInput() ?>

    <?= $form->field($model, 'saldo_neto_c')->textInput() ?>

    <?= $form->field($model, 'plazo_contrato_nc')->textInput() ?>

    <?= $form->field($model, 'saldo_nc')->textInput() ?>

    <?= $form->field($model, 'deterioro_nc')->checkbox() ?>

    <?= $form->field($model, 'valor_de_uso_nc')->textInput() ?>

    <?= $form->field($model, 'saldo_neto_nc')->textInput() ?>

    <?= $form->field($model, 'intereses')->textInput() ?>

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
