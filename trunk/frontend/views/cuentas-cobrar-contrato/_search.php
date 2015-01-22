<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarContratoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobrar-contrato-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'condiciones') ?>

    <?= $form->field($model, 'num_contrato') ?>

    <?= $form->field($model, 'porcentaje_avance') ?>

    <?= $form->field($model, 'plazo_contrato') ?>

    <?php // echo $form->field($model, 'saldo_cont_corriente') ?>

    <?php // echo $form->field($model, 'saldo_cont_ncorriente') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'cliente_id') ?>

    <?php // echo $form->field($model, 'contrato')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
