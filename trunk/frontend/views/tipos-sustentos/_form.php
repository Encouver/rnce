<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TiposSustentos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tipos-sustentos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tipo_cuenta')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
