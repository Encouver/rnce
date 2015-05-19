<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasEInversionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-einversiones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'empresa_relacionada_id') ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'disponibilidad') ?>

    <?= $form->field($model, 'tipo_instrumento') ?>

    <?php // echo $form->field($model, 'nombre_instrumento') ?>

    <?php // echo $form->field($model, 'motivo_retiro') ?>

    <?php // echo $form->field($model, 'numero_acc_bon') ?>

    <?php // echo $form->field($model, 'e_inversion_info_adicional_id') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'fecha_motivo') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
