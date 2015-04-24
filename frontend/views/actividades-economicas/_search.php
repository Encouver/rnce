<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActividadesEconomicasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-economicas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ppal_caev_id') ?>

    <?= $form->field($model, 'comp1_caev_id') ?>

    <?= $form->field($model, 'comp2_caev_id') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'ppal_experiencia') ?>

    <?php // echo $form->field($model, 'comp1_experiencia') ?>

    <?php // echo $form->field($model, 'comp2_experiencia') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
