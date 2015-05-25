<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActivosBienesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-bienes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sys_tipo_bien_id') ?>

    <?= $form->field($model, 'detalle') ?>

    <?= $form->field($model, 'fecha_origen') ?>

    <?= $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'propio')->checkbox() ?>

    <?php // echo $form->field($model, 'origen_id') ?>

    <?php // echo $form->field($model, 'nacional')->checkbox() ?>

    <?php // echo $form->field($model, 'carga_completa')->checkbox() ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'factura_id') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'arrendamiento_id') ?>

    <?php // echo $form->field($model, 'desincorporacion_id') ?>

    <?php // echo $form->field($model, 'mejora')->checkbox() ?>

    <?php // echo $form->field($model, 'perdida_reverso')->checkbox() ?>

    <?php // echo $form->field($model, 'proc_productivo')->checkbox() ?>

    <?php // echo $form->field($model, 'directo')->checkbox() ?>

    <?php // echo $form->field($model, 'proc_ventas')->checkbox() ?>

    <?php // echo $form->field($model, 'metodo_medicion_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
