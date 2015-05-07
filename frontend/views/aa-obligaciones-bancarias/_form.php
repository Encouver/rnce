<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\AaObligacionesBancarias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aa-obligaciones-bancarias-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'num_documento')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'monto_otorgado')->textInput() ?>

    <?= $form->field($model, 'fecha_prestamo')->textInput() ?>

    <?= $form->field($model, 'fecha_vencimiento')->textInput() ?>

    <?= $form->field($model, 'tasa_interes')->textInput() ?>

    <?= $form->field($model, 'condicion_pago_id')->textInput() ?>

    <?= $form->field($model, 'plazo')->textInput() ?>

    <?= $form->field($model, 'tipo_garantia_id')->textInput() ?>

    <?= $form->field($model, 'interes_ejer_econ')->textInput() ?>

    <?= $form->field($model, 'interes_pagar')->textInput() ?>

    <?= $form->field($model, 'importe_deuda')->textInput() ?>

    <?= $form->field($model, 'total_imp_deu_int')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
