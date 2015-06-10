<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasI4CostosPersonalSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i4-costos-personal-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'monto_mano_directa') ?>

    <?= $form->field($model, 'metodo_inflacion_directa') ?>

    <?= $form->field($model, 'desde_directa') ?>

    <?= $form->field($model, 'hasta_directa') ?>

    <?php // echo $form->field($model, 'mdo_ajustado_directa') ?>

    <?php // echo $form->field($model, 'monto_mano_indirecta') ?>

    <?php // echo $form->field($model, 'metodo_inflacion_indirecta') ?>

    <?php // echo $form->field($model, 'desde_indirecta') ?>

    <?php // echo $form->field($model, 'hasta_indirecta') ?>

    <?php // echo $form->field($model, 'mdo_ajustado_indirecta') ?>

    <?php // echo $form->field($model, 'concepto_id') ?>

    <?php // echo $form->field($model, 'cp_objeto_id') ?>

    <?php // echo $form->field($model, 'especifique') ?>

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
