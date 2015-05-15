<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDatosImportaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-datos-importaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'num_guia_nac')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'gastos_mon_extranjera')->textInput() ?>

    <?= $form->field($model, 'sys_divisa_id')->textInput() ?>

    <?= $form->field($model, 'tasa_cambio')->textInput() ?>

    <?= $form->field($model, 'gastos_imp_nacional')->textInput() ?>

    <?= $form->field($model, 'otros_costros_imp_instalacion')->textInput() ?>

    <?= $form->field($model, 'total_costo_adquisicion')->textInput() ?>

    <?= $form->field($model, 'pais_origen_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
