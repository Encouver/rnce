<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\SysTotales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sys-totales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'classname')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'valor')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'id_classname')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'total')->checkbox() ?>

    <?= $form->field($model, 'ahno')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
