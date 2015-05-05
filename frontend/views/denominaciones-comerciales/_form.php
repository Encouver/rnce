<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\DenominacionesComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="denominaciones-comerciales-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'codigo_situr')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cooperativa_capital')->dropDownList([ 'SUPLEMENTARIO' => 'SUPLEMENTARIO', 'LIMITADO' => 'LIMITADO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'cooperativa_distribuicion')->dropDownList([ 'UTILIDADES' => 'UTILIDADES', 'EXCEDENTES' => 'EXCEDENTES', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'contratista_id')->textInput() ?>

    <?= $form->field($model, 'sys_status')->checkbox() ?>

    <?= $form->field($model, 'sys_creado_el')->textInput() ?>

    <?= $form->field($model, 'sys_actualizado_el')->textInput() ?>

    <?= $form->field($model, 'sys_finalizado_el')->textInput() ?>

    <?= $form->field($model, 'tipo_denominacion')->dropDownList([ 'PERSONA NATURAL' => 'PERSONA NATURAL', 'FIRMA PERSONAL' => 'FIRMA PERSONAL', 'COMPAÑIA ANONIMA' => 'COMPAÑIA ANONIMA', 'SOCIEDAD ANONIMA' => 'SOCIEDAD ANONIMA', 'COMANDITA' => 'COMANDITA', 'FUNDACION' => 'FUNDACION', 'ASOCIACION CIVIL' => 'ASOCIACION CIVIL', 'SOCIEDAD CIVIL' => 'SOCIEDAD CIVIL', 'SOCIEDAD DE RESPONSABILIDAD LIMITADA' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA', 'COMPAÑIA NOMBRE COLECTIVO' => 'COMPAÑIA NOMBRE COLECTIVO', 'ORGANIZACION SOCIOPRODUCTIVA' => 'ORGANIZACION SOCIOPRODUCTIVA', 'COOPERATIVA' => 'COOPERATIVA', 'EMPRESA EXTRANJERA' => 'EMPRESA EXTRANJERA', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tipo_subdenominacion')->dropDownList([ 'SOCIEDAD ANONIMA' => 'SOCIEDAD ANONIMA', 'SOCIEDAD ANONIMA DE CAPITAL AUTORIZADO' => 'SOCIEDAD ANONIMA DE CAPITAL AUTORIZADO', 'SOCIEDAD ANONIMA INSCRITA DE CAPITAL ABIERTO' => 'SOCIEDAD ANONIMA INSCRITA DE CAPITAL ABIERTO', 'COMANDITA SIMPLE' => 'COMANDITA SIMPLE', 'COMANDITA POR ACCIONES' => 'COMANDITA POR ACCIONES', 'FUNDACION DEL ESTADO (NACIONAL)' => 'FUNDACION DEL ESTADO (NACIONAL)', 'FUNDACION DEL ESTADO (ESTADAL)' => 'FUNDACION DEL ESTADO (ESTADAL)', 'FUNDACION DEL ESTADO (MUNICIPAL)' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'EMPRESA DE PROPIEDAD SOCIAL DIRECTA COMUNAL' => 'EMPRESA DE PROPIEDAD SOCIAL DIRECTA COMUNAL', 'EMPRESA DE PROPIEDAD SOCIAL INDIRECTA COMUNAL' => 'EMPRESA DE PROPIEDAD SOCIAL INDIRECTA COMUNAL', 'UNIDAD PRODUCTIVA FAMILIAR' => 'UNIDAD PRODUCTIVA FAMILIAR', 'GRUPO DE INTERCAMBIO SOLIDARIO' => 'GRUPO DE INTERCAMBIO SOLIDARIO', 'CON FINES DE LUCRO' => 'CON FINES DE LUCRO', 'SIN FINES DE LUCRO' => 'SIN FINES DE LUCRO', 'CON DOMICILIO EN VENEZUELA' => 'CON DOMICILIO EN VENEZUELA', 'SIN DOMICILIO EN VENEZUELA' => 'SIN DOMICILIO EN VENEZUELA', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
