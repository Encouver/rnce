<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ComisariosAuditores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comisarios-auditores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'fecha_vencimiento')->textInput() ?>

    <?= $form->field($model, 'declaracion_jurada')->checkbox() ?>

    <?= $form->field($model, 'tipo_profesion')->dropDownList([ 'CONTADOR PUBLICO' => 'CONTADOR PUBLICO', 'ADMINISTRADOR' => 'ADMINISTRADOR', 'ECONOMISTA' => 'ECONOMISTA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'fecha_carta')->textInput() ?>

    <?= $form->field($model, 'colegiatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'comisario')->checkbox() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'auditor')->checkbox() ?>

    <?= $form->field($model, 'responsable_contabilidad')->checkbox() ?>

    <?= $form->field($model, 'informe_conversion')->checkbox() ?>

    <?= $form->field($model, 'natural_juridica_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
