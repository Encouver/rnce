<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosBienesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-bienes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sys_tipo_bien_id') ?>

    <?= $form->field($model, 'principio_contable') ?>

    <?= $form->field($model, 'depreciable')->checkbox() ?>

    <?= $form->field($model, 'deterioro')->checkbox() ?>

    <?php // echo $form->field($model, 'detalle') ?>

    <?php // echo $form->field($model, 'origen') ?>

    <?php // echo $form->field($model, 'fecha_origen') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'propio')->checkbox() ?>

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
