<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($objeto_autorizacion, 'objeto_empresa_id')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'domicilio_fabricante_id')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'productos')->textarea(['rows' => 6]) ?>

    <?= $form->field($objeto_autorizacion, 'marcas')->textarea(['rows' => 6]) ?>

    <?= $form->field($objeto_autorizacion, 'origen_producto_id')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'sello_firma')->checkbox() ?>

    <?= $form->field($objeto_autorizacion, 'idioma_redacion_id')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'documento_traducido')->checkbox() ?>

    <?= $form->field($objeto_autorizacion, 'numero_identificacion')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($objeto_autorizacion, 'nombre_interprete')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($objeto_autorizacion, 'fecha_emision')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'fecha_vencimiento')->textInput(['maxlength' => 255]) ?>


    <?= $form->field($objeto_autorizacion, 'persona_juridica_id')->textInput() ?>

    <?= $form->field($objeto_autorizacion, 'tipo_objeto')->dropDownList([ 'DISTRIBUIDOR AUTORIZADO' => 'DISTRIBUIDOR AUTORIZADO', 'DISTRIBUIDOR IMPORTADOR AUTORIZADO' => 'DISTRIBUIDOR IMPORTADOR AUTORIZADO', 'SERVICIOS COMERCIALES AUTORIZADO' => 'SERVICIOS COMERCIALES AUTORIZADO', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($objeto_autorizacion->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $objeto_autorizacion->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
