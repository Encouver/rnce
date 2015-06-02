<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ModificacionesActasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modificaciones-actas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?= $form->field($model, 'documento_registrado_id') ?>

    <?= $form->field($model, 'pago_capital')->checkbox() ?>

    <?= $form->field($model, 'aporte_capitalizar')->checkbox() ?>

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

    <?php // echo $form->field($model, 'razon_social')->checkbox() ?>

    <?php // echo $form->field($model, 'denominacion_comercial')->checkbox() ?>

    <?php // echo $form->field($model, 'domicilio_fiscal')->checkbox() ?>

    <?php // echo $form->field($model, 'domicilio_principal')->checkbox() ?>

    <?php // echo $form->field($model, 'objeto_social')->checkbox() ?>

    <?php // echo $form->field($model, 'representante_legal')->checkbox() ?>

    <?php // echo $form->field($model, 'junta_directiva')->checkbox() ?>

    <?php // echo $form->field($model, 'duracion_empresa')->checkbox() ?>

    <?php // echo $form->field($model, 'cierre_ejercicio')->checkbox() ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
