<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI4CostosPersonal */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i4-costos-personal-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'monto_mano_directa')->textInput() ?>

    <?= $form->field($model, 'metodo_inflacion_directa')->textInput() ?>

    <?= $form->field($model, 'desde_directa')->textInput() ?>

    <?= $form->field($model, 'hasta_directa')->textInput() ?>

    <?= $form->field($model, 'mdo_ajustado_directa')->textInput() ?>

    <?= $form->field($model, 'monto_mano_indirecta')->textInput() ?>

    <?= $form->field($model, 'metodo_inflacion_indirecta')->textInput() ?>

    <?= $form->field($model, 'desde_indirecta')->textInput() ?>

    <?= $form->field($model, 'hasta_indirecta')->textInput() ?>

    <?= $form->field($model, 'mdo_ajustado_indirecta')->textInput() ?>

    <?= $form->field($model, 'concepto_id')->textInput() ?>

    <?= $form->field($model, 'cp_objeto_id')->textInput() ?>

    <?= $form->field($model, 'especifique')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => true]) ?>

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
