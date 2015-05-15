<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ActasConstitutivasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actas-constitutivas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'documento_registrado_id') ?>

    <?= $form->field($model, 'denominacion_comercial_id') ?>

    <?= $form->field($model, 'duracion_empresa_id') ?>

    <?php // echo $form->field($model, 'objeto_social_id') ?>

    <?php // echo $form->field($model, 'razon_social_id') ?>

    <?php // echo $form->field($model, 'domicilio_id') ?>

    <?php // echo $form->field($model, 'accionista_otro') ?>

    <?php // echo $form->field($model, 'comisario_auditor_id') ?>

    <?php // echo $form->field($model, 'cierre_ejercicio_id') ?>

    <?php // echo $form->field($model, 'fecha_modificacion') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'capital_principal')->checkbox() ?>

    <?php // echo $form->field($model, 'pago_capital')->checkbox() ?>

    <?php // echo $form->field($model, 'aporte_capitalizar')->checkbox() ?>

    <?php // echo $form->field($model, 'aumento_capital')->checkbox() ?>

    <?php // echo $form->field($model, 'coreccion_monetaria')->checkbox() ?>

    <?php // echo $form->field($model, 'disminucion_capital')->checkbox() ?>

    <?php // echo $form->field($model, 'limitacion_capital')->checkbox() ?>

    <?php // echo $form->field($model, 'limitacion_capital_afectado')->checkbox() ?>

    <?php // echo $form->field($model, 'fondo_emergencia')->checkbox() ?>

    <?php // echo $form->field($model, 'reintegro_perdida')->checkbox() ?>

    <?php // echo $form->field($model, 'venta_accion')->checkbox() ?>

    <?php // echo $form->field($model, 'fusion_empresarial')->checkbox() ?>

    <?php // echo $form->field($model, 'decreto_div_excedente')->checkbox() ?>

    <?php // echo $form->field($model, 'modificacion_balance')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
