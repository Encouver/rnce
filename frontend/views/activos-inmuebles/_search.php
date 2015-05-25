<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosInmueblesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-inmuebles-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bien_id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'direccion_ubicacion') ?>

    <?= $form->field($model, 'ficha_catastral') ?>

    <?php // echo $form->field($model, 'zonificacion') ?>

    <?php // echo $form->field($model, 'extension') ?>

    <?php // echo $form->field($model, 'titulo_supletorio') ?>

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
