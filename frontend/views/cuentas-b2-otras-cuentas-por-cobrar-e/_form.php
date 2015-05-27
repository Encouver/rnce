<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrarE */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-b2-otras-cuentas-por-cobrar-e-form">

    <?php $form = ActiveForm::begin(); ?>


    <table class="table table-striped">
    <tr>
        <td><?= $form->field($model, 'criterio')->textInput(['maxlength' => true]) ?></td>
        <td><?= $form->field($model, 'origen')->textInput(['maxlength' => true]) ?></td>
        <td><?= $form->field($model, 'fecha')->textInput() ?></td>
    </tr>
    <tr>
        <td><?= $form->field($model, 'garantia')->textInput(['maxlength' => true]) ?></td>
        <td><?= $form->field($model, 'corriente')->checkbox() ?></td>
        <td><?= $form->field($model, 'nocorriente')->checkbox() ?></td>
    </tr>
     <tr>
        <td><?= $form->field($model, 'otro_nombre')->textInput(['maxlength' => true]) ?></td>
    </tr>
</table>

<table>
    <tr>
        <td><?= $form->field($model, 'plazo_contrato_c')->textInput() ?></td>
        <td><?= $form->field($model, 'saldo_c')->textInput() ?></td>
        <td><?= $form->field($model, 'deterioro_c')->checkbox() ?></td>
        <td><?= $form->field($model, 'valor_de_uso_c')->textInput() ?></td>
        <td><?= $form->field($model, 'saldo_neto_c')->textInput() ?></td>
    </tr>
</table>

<table>
     <tr>
        <td><?= $form->field($model, 'plazo_contrato_nc')->textInput() ?></td>
        <td><?= $form->field($model, 'saldo_nc')->textInput() ?></td>
        <td><?= $form->field($model, 'deterioro_nc')->checkbox() ?></td>
        <td><?= $form->field($model, 'valor_de_uso_nc')->textInput() ?></td>
        <td><?= $form->field($model, 'saldo_neto_nc')->textInput() ?></td>
    </tr>
</table>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
