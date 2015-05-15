<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosActivosBiologicos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-activos-biologicos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'catidad')->textInput() ?>

    <?= $form->field($model, 'certificado')->checkbox() ?>

    <?= $form->field($model, 'num_certificado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalles')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
