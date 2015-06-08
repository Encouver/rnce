<?php

use kartik\builder\Form;
use yii\helpers\Html;
use  kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasI2DeclaracionIslr */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-i2-declaracion-islr-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php

        echo '<h2> Cuenta I-2.1 - Declaración de Impuesto Sobre la renta (ISLR): </h2>';
        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->formAttribs
        ]);

    ?>

<!--
    <?/*= $form->field($model, 'tipo_declaracion_id')->textInput() */?>

    <?/*= $form->field($model, 'numero_planilla')->textInput() */?>

    <?/*= $form->field($model, 'num_certificado_elec')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'fecha')->textInput() */?>

    <?/*= $form->field($model, 'total_ingresos')->textInput() */?>

    <?/*= $form->field($model, 'total_egresos')->textInput() */?>

    <?/*= $form->field($model, 'impuesto_determinado')->textInput() */?>

    <?/*= $form->field($model, 'impuesto_pagado')->textInput() */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>


    -->



    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
