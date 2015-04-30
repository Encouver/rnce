<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AEfectivosBancosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aefectivos-bancos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'banco_contratista_id') ?>

    <?= $form->field($model, 'saldo_segun_b') ?>

    <?= $form->field($model, 'nd_no_cont') ?>

    <?= $form->field($model, 'depo_transito') ?>

    <?php // echo $form->field($model, 'nc_no_cont') ?>

    <?php // echo $form->field($model, 'cheques_transito') ?>

    <?php // echo $form->field($model, 'saldo_al_cierre') ?>

    <?php // echo $form->field($model, 'intereses_act_eco') ?>

    <?php // echo $form->field($model, 'tipo_moneda_id') ?>

    <?php // echo $form->field($model, 'monto_moneda_extra') ?>

    <?php // echo $form->field($model, 'tipo_cambio_cierre') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'anho') ?>

    <?php // echo $form->field($model, 'total_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
