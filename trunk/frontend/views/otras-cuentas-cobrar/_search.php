<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OtrasCuentasCobrarSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otras-cuentas-cobrar-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_deudor_id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'origen') ?>

    <?= $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'garantia') ?>

    <?php // echo $form->field($model, 'plazo') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'activo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
