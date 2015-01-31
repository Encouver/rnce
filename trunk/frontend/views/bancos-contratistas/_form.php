<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BancosContratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'num_cuenta')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
