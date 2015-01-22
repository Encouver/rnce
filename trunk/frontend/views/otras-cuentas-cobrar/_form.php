<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\OtrasCuentasCobrar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="otras-cuentas-cobrar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_deudor_id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'origen')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'garantia')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'plazo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'saldo_contabilidad_c')->textInput() ?>

    <?= $form->field($model, 'saldo_contabilidad_nc')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
