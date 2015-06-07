<?php

use kartik\builder\Form;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasD2OtrosTributosPag */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-d2-otros-tributos-pag-form">

    <?php $form = ActiveForm::begin(['id'=>'dynamic-form']); ?>
<!--
    <?/*= $form->field($model, 'otros_tributos_id')->textInput() */?>

    <?/*= $form->field($model, 'saldo_pah')->textInput() */?>

    <?/*= $form->field($model, 'credito_fiscal')->textInput() */?>

    <?/*= $form->field($model, 'monto')->textInput() */?>

    <?/*= $form->field($model, 'debito_fiscal')->textInput() */?>

    <?/*= $form->field($model, 'debito_fiscal_no')->textInput() */?>

    <?/*= $form->field($model, 'importe_pagado')->textInput() */?>

    <?/*= $form->field($model, 'saldo_cierre')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

  -->

    <?php

    echo '<h2> Cuenta D-2 - Otros Tributos pagados/cobrados por anticipado: </h2>';
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$model->formAttribs
    ]);

    ?>


    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon "></i> Beneficiarios</h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_otros_tributos', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                //'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelBeneficiarios[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    //'id',
                    'sys_naturales_juridicas_id',
                    'nro_planilla',
                    'periodo',
                    'monto',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
                <?php foreach ($modelBeneficiarios as $i => $modelBeneficiario): ?>
                    <div class="item panel panel-default"><!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left">Beneficiario</h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            echo Form::widget([       // 3 column layout
                                'model'=>$modelBeneficiario,
                                'form'=>$form,
                                'columns'=>4,
                                'columnSize'=>'xs',
                                'attributes'=>$modelBeneficiario->getFormAttribs($i)
                            ]);
                            ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
