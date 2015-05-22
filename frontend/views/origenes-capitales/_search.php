<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OrigenesCapitalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="origenes-capitales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bien_id') ?>

    <?= $form->field($model, 'banco_contratista_id') ?>

    <?= $form->field($model, 'monto') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'saldo_cierre_anterior') ?>

    <?php // echo $form->field($model, 'saldo_corte') ?>

    <?php // echo $form->field($model, 'fecha_corte') ?>

    <?php // echo $form->field($model, 'monto_aumento') ?>

    <?php // echo $form->field($model, 'saldo_aumento') ?>

    <?php // echo $form->field($model, 'numero_accion') ?>

    <?php // echo $form->field($model, 'valor_acciones') ?>

    <?php // echo $form->field($model, 'saldo_cierre_ajustado') ?>

    <?php // echo $form->field($model, 'fecha_aumento') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'numero_transaccion') ?>

    <?php // echo $form->field($model, 'efectivo')->checkbox() ?>

    <?php // echo $form->field($model, 'banco')->checkbox() ?>

    <?php // echo $form->field($model, 'bien')->checkbox() ?>

    <?php // echo $form->field($model, 'cuenta_pagar')->checkbox() ?>

    <?php // echo $form->field($model, 'decreto')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
