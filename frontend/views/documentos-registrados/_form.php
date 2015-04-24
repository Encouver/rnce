<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\DocumentosRegistrados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="documentos-registrados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'sys_tipo_documento_id')->textInput() ?>

    <?= $form->field($model, 'sys_tipo_registro_id')->textInput() ?>

    <?= $form->field($model, 'circunscripcion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'num_registro_notaria')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'tomo')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'folio')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'fecha_registro')->textInput() ?>

    <?= $form->field($model, 'valor_adquisicion')->textInput() ?>

    <?= $form->field($model, 'fecha_asamblea')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
