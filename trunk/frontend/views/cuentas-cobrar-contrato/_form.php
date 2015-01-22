<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarContrato */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobrar-contrato-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'condiciones')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'num_contrato')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'porcentaje_avance')->textInput() ?>

    <?= $form->field($model, 'plazo_contrato')->textInput() ?>

    <?= $form->field($model, 'saldo_cont_corriente')->textInput() ?>

    <?= $form->field($model, 'saldo_cont_ncorriente')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'contrato')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
