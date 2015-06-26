<?php

use kartik\builder\Form;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasEInversiones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-einversiones-form">

    <?php $form = ActiveForm::begin(['options'=> ['enctype'=>'multipart/form-data']]); ?>

    <?php
    echo Form::widget([       // 3 column layout
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$model->getFormAttribs()
    ]);

    echo Form::widget([       // 3 column layout
        'model'=>$modelInfoAdicional,
        'form'=>$form,
        'columns'=>4,
        'columnSize'=>'xs',
        'attributes'=>$modelInfoAdicional->getFormAttribs()
    ]);

    ?>
    <div id="adquisicion-container">
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoAdquisicion,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoAdquisicion->getFormAttribs()
        ]);
    ?>
    </div>
    <div id="adicion-container">
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoAdicion,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoAdicion->getFormAttribs()
        ]);
    ?>
    </div>
    <div id="retiro-container">
    <?php
        echo Form::widget([       // 3 column layout
            'model'=>$modelTipoMovimientoRetiro,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$modelTipoMovimientoRetiro->getFormAttribs()
        ]);
    ?>
    </div>

    <?php


    $script = <<< JS


    function datosImportados(){
            //if($('#activosb   ienes-nacional').is(':checked') ){
            if($('#cuentaseinversiones-adquisicion').val()==1){
               $('#adquisicion-container').show();
            }//alert($('#activosbienes-nacional').val());
            //if(!$('#activosbienes-nacional').is(':checked')){
             if($('#cuentaseinversiones-adquisicion').val()==0){
                 $('#adquisicion-container').hide();
             }
    }
     $('#activosbienes-nacional').change(function(e){

               datosImportados();
        });

     $('#activosbienes-mejora').change(function(e){

                //if($('#activosbienes-mejora').is(':checked') ){
                if($('#activosbienes-mejora').val()==1){
                   $('#mejora-container').show();
                }//alert($('#activosbienes-nacional').val());
                //if(!$('#activosbienes-mejora').is(':checked')){
                if($('#activosbienes-mejora').val()==0){
                    $('#mejora-container').hide();
                }
        });

        $('#activosbienes-propio').change(function(e){

                //if($('#activosbienes-mejora').is(':checked') ){
                if($('#activosbienes-propio').val()==1){
                   $('#arrendamiento-container').hide();
                }//alert($('#activosbienes-nacional').val());
                //if(!$('#activosbienes-mejora').is(':checked')){
                if($('#activosbienes-propio').val()==0){
                   $('#arrendamiento-container').show();
                }
        });

    $('#activosbienes-proc_productivo').change(function(e){

                    //if($('#activosbienes-proc_productivo').is(':checked')){
                    if($('#activosbienes-proc_productivo').val()==1){
                        $('.field-activosbienes-directo').parent().show();
                        $('.field-activosbienes-proc_ventas').parent().hide();
                    }
                    //if(!$('#activosbienes-proc_productivo').is(':checked')){
                    if($('#activosbienes-proc_productivo').val()==0/*is(':checked')*/){
                        $('.field-activosbienes-directo').parent().hide();
                        $('.field-activosbienes-proc_ventas').parent().show();
                    }
            });
        $('#origen').change(function(e){
                if($('#origen').val()== 1 || $('#origen').val()==4){
                    $('.field-activosbienes-fecha_origen').parent().show();
                    $('.field-activosbienes-nacional').parent().hide();
                    $('#datos-importacion-container').hide();

                }else if ($('#origen').val()==2) {
                    $('.field-activosbienes-fecha_origen').parent().hide();
                    $('.field-activosbienes-nacional').parent().show();
                    datosImportados();
                }else
                {
                    $('.field-activosbienes-fecha_origen').parent().hide();
                    $('.field-activosbienes-nacional').parent().hide();
                }
        });

        $('#activosarrendamientos-tipo_arrendamiento_id').change(function(e){
                if($('#activosarrendamientos-tipo_arrendamiento_id').val()== 2){
                    $('.field-activosarrendamientos-valor_bien_arrendado').parent().show();
                }else
                {
                    $('.field-activosarrendamientos-valor_bien_arrendado').parent().hide();
                }
        });



/*
     $('#activosbienes-factura').change(function(e){

                if($('#activosbienes-factura').is(':checked')){
                    $('#factura-container').show();
                }
                if(!$('#activosbienes-factura').is(':checked')){
                    $('#factura-container').hide();
                }
        });
     $('#activosbienes-documento').change(function(e){

                if($('#activosbienes-documento').is(':checked')){
                    $('#documento-container').show();
                }
                if(!$('#activosbienes-documento').is(':checked')){
                    $('#documento-container').hide();
                }
        });*/



JS;
    $this->registerJs($script);
    ?>
<!--
    <?/*= $form->field($model, 'empresa_relacionada_id')->textInput() */?>

    <?/*= $form->field($model, 'corriente')->checkbox() */?>

    <?/*= $form->field($model, 'disponibilidad')->dropDownList([ 'DISPONIBLES PARA LA VENTA' => 'DISPONIBLES PARA LA VENTA', 'NO DISPONIBLES PARA LA VENTA' => 'NO DISPONIBLES PARA LA VENTA', 'SUBSIDIARIAS' => 'SUBSIDIARIAS', ' NEGOCIOS CONJUNTOS Y ASOCIADAS' => ' NEGOCIOS CONJUNTOS Y ASOCIADAS', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'tipo_instrumento')->dropDownList([ 'ACCIONES' => 'ACCIONES', 'BONOS' => 'BONOS', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'nombre_instrumento')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'motivo_retiro')->dropDownList([ 'CESION' => 'CESION', 'DETERIORO' => 'DETERIORO', 'VENTA' => 'VENTA', ], ['prompt' => '']) */?>

    <?/*= $form->field($model, 'numero_acc_bon')->textInput() */?>

    <?/*= $form->field($model, 'e_inversion_info_adicional_id')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'anho')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'creado_por')->textInput() */?>

    <?/*= $form->field($model, 'actualizado_por')->textInput() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>

    <?/*= $form->field($model, 'fecha_motivo')->textInput() */?>

    -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>



</div>
