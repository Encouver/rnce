<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EfectivoBanco */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="efectivo-banco-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'saldo_banco')->textInput() ?>

    <?= $form->field($model, 'depos_transito')->textInput() ?>

    <?= $form->field($model, 'saldo_contabilidad')->textInput() ?>

    <?= $form->field($model, 'che_transito')->textInput() ?>

    <?= $form->field($model, 'nd_contabilizadas')->textInput() ?>

    <?= $form->field($model, 'nc_contabilizadas')->textInput() ?>

    <?= $form->field($model, 'ano')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
