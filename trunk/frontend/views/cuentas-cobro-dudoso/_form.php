<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobroDudoso */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cobro-dudoso-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'cliente_id')->textInput() ?>

    <?= $form->field($model, 'cta_cobrar30')->textInput() ?>

    <?= $form->field($model, 'cta_cobrar60')->textInput() ?>

    <?= $form->field($model, 'cta_cobrar90')->textInput() ?>

    <?= $form->field($model, 'cta_cobrar_m')->textInput() ?>

    <?= $form->field($model, 'estimacion')->textInput() ?>

    <?= $form->field($model, 'saldo_conta_corriente')->textInput() ?>

    <?= $form->field($model, 'saldo_conta_ncorriente')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
