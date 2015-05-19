<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasEInversiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-einversiones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'empresa_relacionada_id')->textInput() ?>

    <?= $form->field($model, 'corriente')->checkbox() ?>

    <?= $form->field($model, 'disponibilidad')->dropDownList([ 'DISPONIBLES PARA LA VENTA' => 'DISPONIBLES PARA LA VENTA', 'NO DISPONIBLES PARA LA VENTA' => 'NO DISPONIBLES PARA LA VENTA', 'SUBSIDIARIAS' => 'SUBSIDIARIAS', ' NEGOCIOS CONJUNTOS Y ASOCIADAS' => ' NEGOCIOS CONJUNTOS Y ASOCIADAS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_instrumento')->dropDownList([ 'ACCIONES' => 'ACCIONES', 'BONOS' => 'BONOS', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'nombre_instrumento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'motivo_retiro')->dropDownList([ 'CESION' => 'CESION', 'DETERIORO' => 'DETERIORO', 'VENTA' => 'VENTA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'numero_acc_bon')->textInput() ?>

    <?= $form->field($model, 'e_inversion_info_adicional_id')->textInput() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'anho')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'fecha_motivo')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
