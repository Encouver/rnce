<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosEmpresas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-empresas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'contratista')->checkbox() ?>

    <?= $form->field($model, 'empresa_relacionada_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'productor')->checkbox() ?>

    <?= $form->field($model, 'fabricante')->checkbox() ?>

    <?= $form->field($model, 'fabricante_importado')->checkbox() ?>

    <?= $form->field($model, 'distribuidor')->checkbox() ?>

    <?= $form->field($model, 'distribuidor_autorizado')->checkbox() ?>

    <?= $form->field($model, 'distribuidor_importador')->checkbox() ?>

    <?= $form->field($model, 'dist_importador_aut')->checkbox() ?>

    <?= $form->field($model, 'servicio_basico')->checkbox() ?>

    <?= $form->field($model, 'servicio_profesional')->checkbox() ?>

    <?= $form->field($model, 'servicio_comercial')->checkbox() ?>

    <?= $form->field($model, 'ser_comercial_aut')->checkbox() ?>

    <?= $form->field($model, 'obra')->checkbox() ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
