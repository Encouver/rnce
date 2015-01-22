<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobroDudosoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobro-dudoso-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?= $form->field($model, 'cta_cobrar30') ?>

    <?= $form->field($model, 'cta_cobrar60') ?>

    <?php // echo $form->field($model, 'cta_cobrar90') ?>

    <?php // echo $form->field($model, 'cta_cobrar_m') ?>

    <?php // echo $form->field($model, 'estimacion') ?>

    <?php // echo $form->field($model, 'saldo_conta_corriente') ?>

    <?php // echo $form->field($model, 'saldo_conta_ncorriente') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
