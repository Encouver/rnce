<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\Acciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero_comun')->textInput() ?>

    <?= $form->field($model, 'numero_preferencial')->textInput() ?>

    <?= $form->field($model, 'valor_comun')->textInput() ?>

    <?= $form->field($model, 'valor_preferencial')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'tipo_accion')->dropDownList([ 'PRINCIPAL' => 'PRINCIPAL', 'PAGO_CAPITAL' => 'PAGO CAPITAL', 'APORTE_CAPITALIZAR' => 'APORTE CAPITALIZAR', 'AUMENTO_CAPITAL' => 'AUMENTO CAPITAL', 'DISMINUCION_CAPITAL' => 'DISMINUCION CAPITAL', 'FONDO_EMERGENCIA' => 'FONDO EMERGENCIA', 'REINTEGRO_PERDIDA' => 'REINTEGRO PERDIDA', 'VENTA_ACCION' => 'VENTA ACCION', 'FUSION_EMPRESARIAL' => 'FUSION EMPRESARIAL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'suscrito')->checkbox() ?>

    <?= $form->field($model, 'acta_constitutiva_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
