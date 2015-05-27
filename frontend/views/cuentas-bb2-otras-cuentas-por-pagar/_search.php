<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasBb2OtrasCuentasPorPagarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-bb2-otras-cuentas-por-pagar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'criterio') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'garantia') ?>

    <?= $form->field($model, 'plazo') ?>

    <?php // echo $form->field($model, 'saldo_conta_co') ?>

    <?php // echo $form->field($model, 'saldo_conta_nc') ?>

    <?php // echo $form->field($model, 'intereses') ?>

    <?php // echo $form->field($model, 'criterio_id') ?>

    <?php // echo $form->field($model, 'otro_nombre') ?>

    <?php // echo $form->field($model, 'detalle') ?>

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
