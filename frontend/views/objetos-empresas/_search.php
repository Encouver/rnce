<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetosEmpresasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-empresas-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'contratista')->checkbox() ?>

    <?= $form->field($model, 'empresa_relacionada_id') ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el') ?>

    <?php // echo $form->field($model, 'sys_actualizado_el') ?>

    <?php // echo $form->field($model, 'sys_finalizado_el') ?>

    <?php // echo $form->field($model, 'productor')->checkbox() ?>

    <?php // echo $form->field($model, 'fabricante')->checkbox() ?>

    <?php // echo $form->field($model, 'fabricante_importado')->checkbox() ?>

    <?php // echo $form->field($model, 'distribuidor')->checkbox() ?>

    <?php // echo $form->field($model, 'distribuidor_autorizado')->checkbox() ?>

    <?php // echo $form->field($model, 'distribuidor_importador')->checkbox() ?>

    <?php // echo $form->field($model, 'dist_importador_aut')->checkbox() ?>

    <?php // echo $form->field($model, 'servicio_basico')->checkbox() ?>

    <?php // echo $form->field($model, 'servicio_profesional')->checkbox() ?>

    <?php // echo $form->field($model, 'servicio_comercial')->checkbox() ?>

    <?php // echo $form->field($model, 'ser_comercial_aut')->checkbox() ?>

    <?php // echo $form->field($model, 'obra')->checkbox() ?>

    <?php // echo $form->field($model, 'contratista_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
