<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasB1CuentasPorCobrarComercialesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-b1-cuentas-por-cobrar-comerciales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'concepto') ?>

    <?= $form->field($model, 'num_fact_contr') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'porcentaje') ?>

    <?php // echo $form->field($model, 'corriente')->checkbox() ?>

    <?php // echo $form->field($model, 'nocorriente')->checkbox() ?>

    <?php // echo $form->field($model, 'plazo_contrato_c') ?>

    <?php // echo $form->field($model, 'saldo_c') ?>

    <?php // echo $form->field($model, 'deterioro_c')->checkbox() ?>

    <?php // echo $form->field($model, 'valor_de_uso_c') ?>

    <?php // echo $form->field($model, 'saldo_neto_c') ?>

    <?php // echo $form->field($model, 'plazo_contrato_nc') ?>

    <?php // echo $form->field($model, 'saldo_nc') ?>

    <?php // echo $form->field($model, 'deterioro_nc')->checkbox() ?>

    <?php // echo $form->field($model, 'valor_de_uso_nc') ?>

    <?php // echo $form->field($model, 'saldo_neto_nc') ?>

    <?php // echo $form->field($model, 'intereses') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

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
