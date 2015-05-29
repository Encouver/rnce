<?php

use kartik\builder\Form;

use kartik\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasD1IslrPagadoAnticipo */
/* @var $modelBeneficiario common\models\c\CuentasD1D2Beneficiario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-d1-islr-pagado-anticipo-form">

    <?php $form = ActiveForm::begin(['id'=>'dynamic-form']); ?>

    <?php

    echo '<h2> Cuenta D-1 - Impuesto sobre la Renta: </h2>';
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
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
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
                                    'attributes'=>$modelBeneficiario->formAttribs
                                ]);
                            ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>


<!--
    <?/*= $form->field($model, 'isrl_pagado')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'nro_documento')->textInput() */?>

    <?/*= $form->field($model, 'saldo_ph')->textInput() */?>

    <?/*= $form->field($model, 'importe_pagado_ejer_econo')->textInput() */?>

    <?/*= $form->field($model, 'importe_aplicado_ejer_econo')->textInput() */?>

    <?/*= $form->field($model, 'saldo_cierre')->textInput() */?>

    <?/*= $form->field($model, 'monto')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

   --> <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

 $script = <<< JS

            $(".dynamicform_wrapper").on("beforeInsert", function(e, item) {
                console.log("beforeInsert");
            });

            $(".dynamicform_wrapper").on("afterInsert", function(e, item) {
                console.log("afterInsert");
            });

            $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {
                if (! confirm("Are you sure you want to delete this item?")) {
                    return false;
                }
                return true;
            });

            $(".dynamicform_wrapper").on("afterDelete", function(e) {
                console.log("Deleted item!");
            });

            $(".dynamicform_wrapper").on("limitReached", function(e, item) {
                alert("Limit reached");
            });


JS;
$this->registerJs($script);
?>