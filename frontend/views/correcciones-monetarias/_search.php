<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CorreccionesMonetariasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correcciones-monetarias-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_aumento') ?>

    <?= $form->field($model, 'valor_accion') ?>

    <?= $form->field($model, 'variacion_valor') ?>

    <?= $form->field($model, 'total_accion') ?>

    <?php // echo $form->field($model, 'monto_capital_legal') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'certificacion_aporte_id') ?>

    <?php // echo $form->field($model, 'fecha_informe') ?>

    <?php // echo $form->field($model, 'valor_accion_comun') ?>

    <?php // echo $form->field($model, 'variacion_valor_comun') ?>

    <?php // echo $form->field($model, 'total_accion_comun') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
