<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\Certificados */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificados-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'numero_asociacion')->textInput() ?>

    <?= $form->field($model, 'numero_aportacion')->textInput() ?>

    <?= $form->field($model, 'numero_rotativo')->textInput() ?>

    <?= $form->field($model, 'numero_inversion')->textInput() ?>

    <?= $form->field($model, 'valor_asociacion')->textInput() ?>

    <?= $form->field($model, 'valor_aportacion')->textInput() ?>

    <?= $form->field($model, 'valor_rotativo')->textInput() ?>

    <?= $form->field($model, 'valor_inversion')->textInput() ?>

    <?= $form->field($model, 'tipo_certificado')->dropDownList([ 'PRNCIPAL' => 'PRNCIPAL', 'PRINCIPAL' => 'PRINCIPAL', 'PAGO_CAPITAL' => 'PAGO CAPITAL', 'APORTE_CAPITALIZAR' => 'APORTE CAPITALIZAR', 'AUMENTO_CAPITAL' => 'AUMENTO CAPITAL', 'DISMINUCION_CAPITAL' => 'DISMINUCION CAPITAL', 'FONDO_EMERGENCIA' => 'FONDO EMERGENCIA', 'REINTEGRO_PERDIDA' => 'REINTEGRO PERDIDA', 'VENTA_ACCION' => 'VENTA ACCION', 'FUSION_EMPRESARIAL' => 'FUSION EMPRESARIAL', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'suscrito')->checkbox() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
