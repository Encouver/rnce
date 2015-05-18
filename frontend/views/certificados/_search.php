<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CertificadosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="certificados-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'numero_asociacion') ?>

    <?= $form->field($model, 'numero_aportacion') ?>

    <?= $form->field($model, 'numero_rotativo') ?>

    <?= $form->field($model, 'numero_inversion') ?>

    <?php // echo $form->field($model, 'valor_asociacion') ?>

    <?php // echo $form->field($model, 'valor_aportacion') ?>

    <?php // echo $form->field($model, 'valor_rotativo') ?>

    <?php // echo $form->field($model, 'valor_inversion') ?>

    <?php // echo $form->field($model, 'tipo_certificado') ?>

    <?php // echo $form->field($model, 'suscrito')->checkbox() ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
