<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CertificadosDisminuidosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificados-disminuidos-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'justificacion') ?>

    <?= $form->field($model, 'tipo_disminucion') ?>

    <?= $form->field($model, 'valor_asociacion') ?>

    <?= $form->field($model, 'valor_aportacion') ?>

    <?php // echo $form->field($model, 'valor_rotativo') ?>

    <?php // echo $form->field($model, 'valor_inversion') ?>

    <?php // echo $form->field($model, 'numero_asociacion') ?>

    <?php // echo $form->field($model, 'numero_aportacion') ?>

    <?php // echo $form->field($model, 'numero_rotativo') ?>

    <?php // echo $form->field($model, 'numero_inversion') ?>

    <?php // echo $form->field($model, 'valor_asociacion_actual') ?>

    <?php // echo $form->field($model, 'valor_aportacion_actual') ?>

    <?php // echo $form->field($model, 'valor_rotativo_actual') ?>

    <?php // echo $form->field($model, 'valor_inversion_actual') ?>

    <?php // echo $form->field($model, 'numero_asoacion_actual') ?>

    <?php // echo $form->field($model, 'numero_aportacion_actual') ?>

    <?php // echo $form->field($model, 'numero_rotativo_actual') ?>

    <?php // echo $form->field($model, 'numero_inversion_actual') ?>

    <?php // echo $form->field($model, 'capital_social') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'actual')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
