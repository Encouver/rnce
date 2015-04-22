<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rif')->textInput() ?>

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'principio_contable')->dropDownList([ 'PYME' => 'PYME', 'OSP' => 'OSP', 'FP' => 'FP', 'PN' => 'PN', 'COOPERATIVA' => 'COOPERATIVA', 'ESPECIAL' => 'ESPECIAL', 'GRAN ENTIDAD' => 'GRAN ENTIDAD', 'EMPRESA DE SEGURO' => 'EMPRESA DE SEGURO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'ppal_caev_id')->textInput() ?>

    <?= $form->field($model, 'comp1_caev_id')->textInput() ?>

    <?= $form->field($model, 'comp2_caev_id')->textInput() ?>

    <?= $form->field($model, 'contacto_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
