<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasCInventarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cinventarios-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo_inventario_id')->textInput() ?>

    <?= $form->field($model, 'detalle_inventario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tecnica_medicion_id')->textInput() ?>

    <?= $form->field($model, 'formula_tecnica_id')->textInput() ?>

    <?= $form->field($model, 'inventario_inicial')->textInput() ?>

    <?= $form->field($model, 'compra_ejercicio')->textInput() ?>

    <?= $form->field($model, 'ventas_ejercicio')->textInput() ?>

    <?= $form->field($model, 'inventario_final')->textInput() ?>

    <?= $form->field($model, 'valor_neto_realizacion')->textInput() ?>

    <?= $form->field($model, 'frecuencia_rotacion')->textInput() ?>

    <?= $form->field($model, 'variacion_inflacion')->textInput() ?>

    <?= $form->field($model, 'costo_ajustado')->textInput() ?>

    <?= $form->field($model, 'deterioro')->textInput() ?>

    <?= $form->field($model, 'reverso_deterioro')->textInput() ?>

    <?= $form->field($model, 'valor_neto_ajus_cierre')->textInput() ?>

    <?= $form->field($model, 'creado_por')->textInput() ?>

    <?= $form->field($model, 'actualizado_por')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
