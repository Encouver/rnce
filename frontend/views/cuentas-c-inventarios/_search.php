<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCInventariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-cinventarios-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tipo_inventario_id') ?>

    <?= $form->field($model, 'detalle_inventario') ?>

    <?= $form->field($model, 'tecnica_medicion_id') ?>

    <?= $form->field($model, 'formula_tecnica_id') ?>

    <?php // echo $form->field($model, 'inventario_inicial') ?>

    <?php // echo $form->field($model, 'compra_ejercicio') ?>

    <?php // echo $form->field($model, 'ventas_ejercicio') ?>

    <?php // echo $form->field($model, 'inventario_final') ?>

    <?php // echo $form->field($model, 'valor_neto_realizacion') ?>

    <?php // echo $form->field($model, 'frecuencia_rotacion') ?>

    <?php // echo $form->field($model, 'variacion_inflacion') ?>

    <?php // echo $form->field($model, 'costo_ajustado') ?>

    <?php // echo $form->field($model, 'deterioro') ?>

    <?php // echo $form->field($model, 'reverso_deterioro') ?>

    <?php // echo $form->field($model, 'valor_neto_ajus_cierre') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
