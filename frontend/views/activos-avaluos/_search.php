<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosAvaluosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-avaluos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'bien_id') ?>

    <?= $form->field($model, 'valor') ?>

    <?= $form->field($model, 'fecha_informe') ?>

    <?= $form->field($model, 'perito_id') ?>

    <?php // echo $form->field($model, 'gremio_id') ?>

    <?php // echo $form->field($model, 'num_inscripcion_gremio') ?>

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
