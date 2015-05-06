<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'objeto_empresa_id')->textInput() ?>

    <?= $form->field($model, 'domicilio_fabricante_id')->textInput() ?>

    <?= $form->field($model, 'productos')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'marcas')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'origen_producto_id')->textInput() ?>

    <?= $form->field($model, 'sello_firma')->checkbox() ?>

    <?= $form->field($model, 'idioma_redacion_id')->textInput() ?>

    <?= $form->field($model, 'documento_traducido')->checkbox() ?>

    <?= $form->field($model, 'numero_identificacion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'nombre_interprete')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'fecha_emision')->textInput() ?>

    <?= $form->field($model, 'fecha_vencimiento')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'persona_juridica_id')->textInput() ?>

    <?= $form->field($model, 'tipo_objeto')->dropDownList([ 'DISTRIBUIDOR AUTORIZADO' => 'DISTRIBUIDOR AUTORIZADO', 'DISTRIBUIDOR IMPORTADOR AUTORIZADO' => 'DISTRIBUIDOR IMPORTADOR AUTORIZADO', 'SERVICIOS COMERCIALES AUTORIZADO' => 'SERVICIOS COMERCIALES AUTORIZADO', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
