<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventariosCSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventarios-c-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tecnica_medicion') ?>

    <?= $form->field($model, 'formula_calculo') ?>

    <?= $form->field($model, 'costo_adquisicion') ?>

    <?= $form->field($model, 'ajuste_inflacion') ?>

    <?php // echo $form->field($model, 'reservo_deterioro') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'ano') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
