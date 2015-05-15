<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosAvaluos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-avaluos-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'valor')->textInput() ?>

    <?= $form->field($model, 'fecha_informe')->textInput() ?>

    <?= $form->field($model, 'perito_id')->textInput() ?>

    <?= $form->field($model, 'gremio_id')->textInput() ?>

    <?= $form->field($model, 'num_inscripcion_gremio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
