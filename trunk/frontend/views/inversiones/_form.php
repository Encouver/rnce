<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Inversiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inversiones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'valor_desvalorizacion')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'activo')->checkbox() ?>

    <?= $form->field($model, 'plazo')->textInput() ?>

    <?= $form->field($model, 'tasa_interes')->textInput() ?>

    <?= $form->field($model, 'tipo_inversion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
