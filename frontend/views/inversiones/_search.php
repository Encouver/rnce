<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InversionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inversiones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'banco_id') ?>

    <?= $form->field($model, 'costo_adquisicion') ?>

    <?= $form->field($model, 'valor_desvalorizacion') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'activo')->checkbox() ?>

    <?php // echo $form->field($model, 'plazo') ?>

    <?php // echo $form->field($model, 'tasa_interes') ?>

    <?php // echo $form->field($model, 'tipo_inversion') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
