<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origenes-capitales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_origen')->dropDownList([ 'EFECTIVO' => 'EFECTIVO', 'EECTIVO EN BANCO' => 'EECTIVO EN BANCO', 'PROPIEDADES PLANTAS Y EQUIPOS' => 'PROPIEDADES PLANTAS Y EQUIPOS', 'INVENTARIO DE MERCANCIA' => 'INVENTARIO DE MERCANCIA', 'ACTIVOS BIOLOGICOS' => 'ACTIVOS BIOLOGICOS', 'ACTIVOS INTANGIBLES' => 'ACTIVOS INTANGIBLES', 'CUENTAS POR PAGAR ACCIONISTAS' => 'CUENTAS POR PAGAR ACCIONISTAS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'banco_contratista_id')->textInput() ?>

    <?= $form->field($model, 'monto')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'saldo_cierre_anterior')->textInput() ?>

    <?= $form->field($model, 'saldo_corte')->textInput() ?>

    <?= $form->field($model, 'fecha_corte')->textInput() ?>

    <?= $form->field($model, 'monto_aumento')->textInput() ?>

    <?= $form->field($model, 'saldo_aumento')->textInput() ?>

    <?= $form->field($model, 'numero_accion')->textInput() ?>

    <?= $form->field($model, 'valor_acciones')->textInput() ?>

    <?= $form->field($model, 'saldo_cierre_ajustado')->textInput() ?>

    <?= $form->field($model, 'fecha_aumento')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

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
