<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasJuridicas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-juridicas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rif')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'razon_social')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'numero_identificacion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'tipo_nacionalidad')->dropDownList([ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
