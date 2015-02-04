<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarSprivpub */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobrar-sprivpub-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'venta')->checkbox() ?>

    <?= $form->field($model, 'servicio')->checkbox() ?>

    <?= $form->field($model, 'obras')->checkbox() ?>

    <?= $form->field($model, 'num_contrato_factura')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'monto_contrato_f')->textInput() ?>

    <?= $form->field($model, 'procentaje_a')->textInput() ?>

    <?= $form->field($model, 'plazo_contrato')->textInput() ?>

    <?= $form->field($model, 'contatista_id')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <?= $form->field($model, 'tipo_cuenta')->dropDownList([ 'pub' => 'Pub', 'pri' => 'Pri', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
