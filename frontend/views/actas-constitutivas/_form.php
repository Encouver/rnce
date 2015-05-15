<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ActasConstitutivas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actas-constitutivas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'documento_registrado_id')->textInput() ?>

    <?= $form->field($model, 'denominacion_comercial_id')->textInput() ?>

    <?= $form->field($model, 'duracion_empresa_id')->textInput() ?>

    <?= $form->field($model, 'objeto_social_id')->textInput() ?>

    <?= $form->field($model, 'razon_social_id')->textInput() ?>

    <?= $form->field($model, 'domicilio_id')->textInput() ?>

    <?= $form->field($model, 'accionista_otro')->textInput() ?>

    <?= $form->field($model, 'comisario_auditor_id')->textInput() ?>

    <?= $form->field($model, 'cierre_ejercicio_id')->textInput() ?>

    <?= $form->field($model, 'fecha_modificacion')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'capital_principal')->checkbox() ?>

    <?= $form->field($model, 'pago_capital')->checkbox() ?>

    <?= $form->field($model, 'aporte_capitalizar')->checkbox() ?>

    <?= $form->field($model, 'aumento_capital')->checkbox() ?>

    <?= $form->field($model, 'coreccion_monetaria')->checkbox() ?>

    <?= $form->field($model, 'disminucion_capital')->checkbox() ?>

    <?= $form->field($model, 'limitacion_capital')->checkbox() ?>

    <?= $form->field($model, 'limitacion_capital_afectado')->checkbox() ?>

    <?= $form->field($model, 'fondo_emergencia')->checkbox() ?>

    <?= $form->field($model, 'reintegro_perdida')->checkbox() ?>

    <?= $form->field($model, 'venta_accion')->checkbox() ?>

    <?= $form->field($model, 'fusion_empresarial')->checkbox() ?>

    <?= $form->field($model, 'decreto_div_excedente')->checkbox() ?>

    <?= $form->field($model, 'modificacion_balance')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
