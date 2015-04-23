<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\Direcciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="direcciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'zona')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'calle')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'casa')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nivel')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'numero')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'referencia')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sys_estado_id')->textInput() ?>

    <?= $form->field($model, 'sys_municipio_id')->textInput() ?>

    <?= $form->field($model, 'sys_parroquia_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
