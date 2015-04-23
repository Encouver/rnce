<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\RelacionesContratos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="relaciones-contratos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_contrato')->dropDownList([ 'OBRAS' => 'OBRAS', 'SERVICIOS' => 'SERVICIOS', 'BIENES' => 'BIENES', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nombre_proyecto')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fecha_inicio')->textInput() ?>

    <?= $form->field($model, 'fecha_fin')->textInput() ?>

    <?= $form->field($model, 'monto_contrato')->textInput() ?>

    <?= $form->field($model, 'anticipo_recibido')->textInput() ?>

    <?= $form->field($model, 'porcentaje_ejecucion')->textInput() ?>

    <?= $form->field($model, 'evaluacion_ente')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'natural_juridica_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
