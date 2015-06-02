<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasB2OtrasCuentasPorCobrarESearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-b2-otras-cuentas-por-cobrar-e-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'criterio') ?>

    <?= $form->field($model, 'origen') ?>

    <?= $form->field($model, 'fecha') ?>

    <?= $form->field($model, 'garantia') ?>

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

    <?php // echo $form->field($model, 'otro_nombre') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'empresa') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
