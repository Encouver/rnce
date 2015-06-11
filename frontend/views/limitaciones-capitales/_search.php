<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LimitacionesCapitalesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="limitaciones-capitales-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'afecta')->checkbox() ?>

    <?= $form->field($model, 'fecha_cierre') ?>

    <?= $form->field($model, 'capital_social') ?>

    <?= $form->field($model, 'total_patrimonio') ?>

    <?php // echo $form->field($model, 'porcentaje_descapitalizacion') ?>

    <?php // echo $form->field($model, 'supuesto')->checkbox() ?>

    <?php // echo $form->field($model, 'monto_perdida') ?>

    <?php // echo $form->field($model, 'fecha_limitacion') ?>

    <?php // echo $form->field($model, 'capital_social_actualizado') ?>

    <?php // echo $form->field($model, 'certificacion_aporte_id') ?>

    <?php // echo $form->field($model, 'reintegro')->checkbox() ?>

    <?php // echo $form->field($model, 'capital_legal') ?>

    <?php // echo $form->field($model, 'saldo_perdida') ?>

    <?php // echo $form->field($model, 'creado_por') ?>

    <?php // echo $form->field($model, 'actualizado_por') ?>

    <?php // echo $form->field($model, 'sys_status')->checkbox() ?>

    <?php // echo $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'fecha_informe') ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <?php // echo $form->field($model, 'documento_registrado_id') ?>

    <?php // echo $form->field($model, 'actual')->checkbox() ?>

    <?php // echo $form->field($model, 'valor_accion') ?>

    <?php // echo $form->field($model, 'valor_accion_comun') ?>

    <?php // echo $form->field($model, 'total_accion') ?>

    <?php // echo $form->field($model, 'total_accion_comun') ?>

    <?php // echo $form->field($model, 'valor_accion_actual') ?>

    <?php // echo $form->field($model, 'valor_accion_comun_actual') ?>

    <?php // echo $form->field($model, 'capital_legal_actual') ?>

    <?php // echo $form->field($model, 'total_capital') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
