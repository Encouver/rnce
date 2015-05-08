<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accionistas-otros-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'natural_juridica_id')->textInput() ?>

    <?= $form->field($model, 'porcentaje_accionario')->textInput() ?>

    <?= $form->field($model, 'valor_compra')->textInput() ?>

    <?= $form->field($model, 'fecha')->textInput() ?>

    <?= $form->field($model, 'accionista')->checkbox() ?>

    <?= $form->field($model, 'junta_directiva')->checkbox() ?>

    <?= $form->field($model, 'rep_legal')->checkbox() ?>

    <?= $form->field($model, 'cargo')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'repr_legal_vigencia')->textInput() ?>

    <?= $form->field($model, 'empresa_fusionada_id')->textInput() ?>

    <?= $form->field($model, 'tipo_obligacion')->dropDownList([ 'FIRMA CONJUNTA' => 'FIRMA CONJUNTA', 'FIRMA SEPARADA' => 'FIRMA SEPARADA', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
