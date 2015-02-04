<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\NotasRevelatoriasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="notas-revelatorias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nota') ?>

    <?= $form->field($model, 'usuario_id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'ano') ?>

    <?php // echo $form->field($model, 'cuenta') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
