<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosConstruccionesInmuebles */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-construcciones-inmuebles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bien_id')->textInput() ?>

    <?= $form->field($model, 'area_construccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'porcentaje_ejecucion')->textInput() ?>

    <?= $form->field($model, 'monto_ejecutado')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
