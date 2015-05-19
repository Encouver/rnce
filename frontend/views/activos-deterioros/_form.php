<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosDeterioros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-deterioros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'valor_razonable')->textInput() ?>

    <?= $form->field($model, 'costo_disposicion')->textInput() ?>

    <?= $form->field($model, 'valor_uso')->textInput() ?>

    <?= $form->field($model, 'acumulado_ejer_ant')->textInput() ?>

    <?= $form->field($model, 'ejercicios_anteriores')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
