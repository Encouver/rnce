<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarSprivpubSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobrar-sprivpub-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'venta')->checkbox() ?>

    <?= $form->field($model, 'servicio')->checkbox() ?>

    <?= $form->field($model, 'obras')->checkbox() ?>

    <?= $form->field($model, 'num_contrato_factura') ?>

    <?php // echo $form->field($model, 'monto_contrato_f') ?>

    <?php // echo $form->field($model, 'procentaje_a') ?>

    <?php // echo $form->field($model, 'plazo_contrato') ?>

    <?php // echo $form->field($model, 'contatista_id') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'tipo_cuenta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
