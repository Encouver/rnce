<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccionistasOtrosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accionistas-otros-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'natural_juridica_id') ?>

    <?= $form->field($model, 'porcentaje_accionario') ?>

    <?= $form->field($model, 'valor_compra') ?>

    <?php // echo $form->field($model, 'fecha') ?>

    <?php // echo $form->field($model, 'accionista')->checkbox() ?>

    <?php // echo $form->field($model, 'junta_directiva')->checkbox() ?>

    <?php // echo $form->field($model, 'rep_legal')->checkbox() ?>

    <?php // echo $form->field($model, 'cargo') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'repr_legal_vigencia') ?>

    <?php // echo $form->field($model, 'empresa_fusionada_id') ?>

    <?php // echo $form->field($model, 'tipo_obligacion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
