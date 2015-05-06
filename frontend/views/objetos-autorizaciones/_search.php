<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetosAutorizacionesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'objeto_empresa_id') ?>

    <?= $form->field($model, 'domicilio_fabricante_id') ?>

    <?= $form->field($model, 'productos') ?>

    <?= $form->field($model, 'marcas') ?>

    <?php // echo $form->field($model, 'origen_producto_id') ?>

    <?php // echo $form->field($model, 'sello_firma')->checkbox() ?>

    <?php // echo $form->field($model, 'idioma_redacion_id') ?>

    <?php // echo $form->field($model, 'documento_traducido')->checkbox() ?>

    <?php // echo $form->field($model, 'numero_identificacion') ?>

    <?php // echo $form->field($model, 'nombre_interprete') ?>

    <?php // echo $form->field($model, 'fecha_emision') ?>

    <?php // echo $form->field($model, 'fecha_vencimiento') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'persona_juridica_id') ?>

    <?php // echo $form->field($model, 'tipo_objeto') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
