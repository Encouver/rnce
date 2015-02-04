<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VariablesGlobales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="variables-globales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'campo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cuenta_afectada')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
