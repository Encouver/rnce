<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AccionesDisminuidasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acciones-disminuidas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'justificacion') ?>

    <?= $form->field($model, 'tipo_disminucion') ?>

    <?= $form->field($model, 'valor_comun') ?>

    <?= $form->field($model, 'valor_preferencial') ?>

    <?php // echo $form->field($model, 'numero_comun') ?>

    <?php // echo $form->field($model, 'numero_preferencial') ?>

    <?php // echo $form->field($model, 'acta_constitutiva_id') ?>

    <?php // echo $form->field($model, 'valor_comun_actual') ?>

    <?php // echo $form->field($model, 'valor_preferencial_actual') ?>

    <?php // echo $form->field($model, 'numero_comun_actual') ?>

    <?php // echo $form->field($model, 'numero_preferencial_actual') ?>

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
