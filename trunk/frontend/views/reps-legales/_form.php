<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RepsLegales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reps-legales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'persona_natural_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
