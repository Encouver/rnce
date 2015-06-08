<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasI2DeclaracionIvaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i2-declaracion-iva-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'periodo_id') ?>

    <?= $form->field($model, 'certificado_electronico') ?>

    <?= $form->field($model, 'ventas_grabadas') ?>

    <?= $form->field($model, 'ventas_no_grabadas') ?>

    <?php // echo $form->field($model, 'ingresos_totales') ?>

    <?php // echo $form->field($model, 'debito_fiscal') ?>

    <?php // echo $form->field($model, 'compras_gravadas') ?>

    <?php // echo $form->field($model, 'compras_no_gravadas') ?>

    <?php // echo $form->field($model, 'egresos_totales_compra') ?>

    <?php // echo $form->field($model, 'credito_fiscal') ?>

    <?php // echo $form->field($model, 'imp_pagar_compensar') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
