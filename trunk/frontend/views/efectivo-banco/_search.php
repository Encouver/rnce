<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfectivoBancoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="efectivo-banco-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'banco_id') ?>

    <?= $form->field($model, 'saldo_banco') ?>

    <?= $form->field($model, 'depos_transito') ?>

    <?php // echo $form->field($model, 'saldo_contabilidad') ?>

    <?php // echo $form->field($model, 'che_transito') ?>

    <?php // echo $form->field($model, 'nd_contabilizadas') ?>

    <?php // echo $form->field($model, 'nc_contabilizadas') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
