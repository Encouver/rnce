<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\BancosContratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'banco_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'num_cuenta')->textInput() ?>

    <?= $form->field($model, 'tipo_moneda')->dropDownList([ 'BOLIVARES' => 'BOLIVARES', 'DOLARES' => 'DOLARES', 'EUROS' => 'EUROS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_cuenta')->dropDownList([ 'CUENTA CORRIENTE' => 'CUENTA CORRIENTE', 'CUENTA CORRIENTE CON INTERESES / REMUNERADA' => 'CUENTA CORRIENTE CON INTERESES / REMUNERADA', 'CUENTA DE AHORROS' => 'CUENTA DE AHORROS', 'CUENTA EN MONEDA EXTRANGERA' => 'CUENTA EN MONEDA EXTRANGERA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'estatus_cuenta')->dropDownList([ 'ACTIVA' => 'ACTIVA', 'INACTIVA' => 'INACTIVA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
