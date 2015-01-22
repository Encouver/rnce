<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\inversiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inversiones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'condiciones')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'valor_desvalorizacion')->textInput() ?>

    <?= $form->field($model, 'saldo_contabilidad')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
