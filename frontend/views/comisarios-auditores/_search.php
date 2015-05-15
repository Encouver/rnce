<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComisariosAuditoresSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comisarios-auditores-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_vencimiento') ?>

    <?= $form->field($model, 'declaracion_jurada')->checkbox() ?>

    <?= $form->field($model, 'tipo_profesion') ?>

    <?= $form->field($model, 'fecha_carta') ?>

    <?php // echo $form->field($model, 'colegiatura') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'comisario')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'auditor')->checkbox() ?>

    <?php // echo $form->field($model, 'responsable_contabilidad')->checkbox() ?>

    <?php // echo $form->field($model, 'informe_conversion')->checkbox() ?>

    <?php // echo $form->field($model, 'natural_juridica_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
