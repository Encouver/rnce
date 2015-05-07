<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AaObligacionesBancariasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aa-obligaciones-bancarias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'banco_id') ?>

    <?= $form->field($model, 'num_documento') ?>

    <?= $form->field($model, 'monto_otorgado') ?>

    <?php // echo $form->field($model, 'fecha_prestamo') ?>

    <?php // echo $form->field($model, 'fecha_vencimiento') ?>

    <?php // echo $form->field($model, 'tasa_interes') ?>

    <?php // echo $form->field($model, 'condicion_pago_id') ?>

    <?php // echo $form->field($model, 'plazo') ?>

    <?php // echo $form->field($model, 'tipo_garantia_id') ?>

    <?php // echo $form->field($model, 'interes_ejer_econ') ?>

    <?php // echo $form->field($model, 'interes_pagar') ?>

    <?php // echo $form->field($model, 'importe_deuda') ?>

    <?php // echo $form->field($model, 'total_imp_deu_int') ?>

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
