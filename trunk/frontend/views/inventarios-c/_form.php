<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\InventariosC */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="inventarios-c-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tecnica_medicion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'formula_calculo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'ajuste_inflacion')->textInput() ?>

    <?= $form->field($model, 'reservo_deterioro')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
