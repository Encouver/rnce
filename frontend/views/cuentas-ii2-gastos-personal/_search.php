<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasIi2GastosPersonalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-ii2-gastos-personal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'concepto_id') ?>

    <?= $form->field($model, 'administracion') ?>

    <?= $form->field($model, 'admin_metodo_id') ?>

    <?= $form->field($model, 'administracion_ajustadas') ?>

    <?php // echo $form->field($model, 'ventas') ?>

    <?php // echo $form->field($model, 'ventas_metodo_id') ?>

    <?php // echo $form->field($model, 'ventas_ajustadas') ?>

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
