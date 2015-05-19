<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasIi1GastosOperacionalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-ii1-gastos-operacionales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_gasto') ?>

    <?= $form->field($model, 'ventas_hist') ?>

    <?= $form->field($model, 'ventas_ajustado') ?>

    <?= $form->field($model, 'admin_hist') ?>

    <?php // echo $form->field($model, 'admin_ajustado') ?>

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
