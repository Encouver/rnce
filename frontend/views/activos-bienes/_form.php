<?php

use kartik\builder\Form;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosBienes */
/* @var $modelDatosImportacion common\models\a\ActivosDatosImportaciones */


/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-bienes-form">


    <?php $form = ActiveForm::begin(/*[
        'fieldConfig' => [
            'template' => "<div class=\"row\">
                                            <div class=\"col-xs-6\">{label}</div>\n<div class=\"col-xs-6 text-right\">{hint}</div>
                                        \n<div class=\"col-xs-12\">{input}</div>
                                        </div>",
            ],
        ]*/); ?>
<!--
    <?/*=$form->errorSummary($model);*/?>

-->
    <?php

        echo '<h2> Datos Básicos del Bien: </h2>';
        echo Form::widget([       // 3 column layout
            'model'=>$model,
            'form'=>$form,
            'columns'=>4,
            'columnSize'=>'xs',
            'attributes'=>$model->getFormAttribs()
        ]);

        //if($model->origen_id == 2 && !$model->nacional ) {
            echo '<div id="datos-importacion-container" style="display: none;">';
            echo '<h2> Datos de importación: </h2>';
            echo Form::widget([       // 3 column layout
                'model' => $modelDatosImportacion,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelDatosImportacion->getFormAttribs($model)
            ]);
            echo '</div>';
       // }

        if($modelBienTipo != null) {
            echo '<h2> Datos Correspondientes al tipo de bien: </h2>';
            echo Form::widget([       // 3 column layout
                'model' => $modelBienTipo,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelBienTipo->getFormAttribs($model)
            ]);
        }

        //if($model->factura) {
            echo '<div id="factura-container" style="display: none;">';
            echo '<h2> Datos de la Factura: </h2>';
            echo Form::widget([       // 3 column layout
                'model' => $modelFactura,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelFactura->getFormAttribs($model)
            ]);
            echo '</div>';
        //}

        //if($model->documento) {
            echo '<div id="documento-container" style="display: none;">';
            echo '<h2> Datos del Documento Registrado: </h2>';
            echo Form::widget([       // 3 column layout
                'model' => $modelDocumento,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelDocumento->getFormAttribs($model)
            ]);
            echo '</div>';
        //}
        if($model->deterioro()) {
            echo '<h2> Datos del Deterioro: </h2>';
            echo Form::widget([       // 3 column layout
                'model' => $modelDeterioro,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelDeterioro->getFormAttribs()
            ]);
        }


        echo '<h2> Depreciación/Amortización: </h2>';
        echo Form::widget([       // 3 column layout
                'model' => $modelDepreciacion,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelDepreciacion->getFormAttribs()
            ]);


    $script = <<< JS

     $('#activosbienes-nacional').change(function(e){

                if($('#activosbienes-nacional').is(':checked') ){
                    $('#datos-importacion-container').show();
                }//alert($('#activosbienes-nacional').val());
                if(!$('#activosbienes-nacional').is(':checked')){
                    $('#datos-importacion-container').hide();
                }
        });
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
        });
        $('#origen').change(function(e){
                if($('#origen').val()== 1 || $('#origen').val()==4){
                    $('.field-activosbienes-fecha_origen').parent().show();
                    $('.field-activosbienes-nacional').parent().hide();
                }else if ($('#origen').val()==2) {
                    $('.field-activosbienes-fecha_origen').parent().hide();
                    $('.field-activosbienes-nacional').parent().show();
                }else
                {
                    $('.field-activosbienes-fecha_origen').parent().hide();
                    $('.field-activosbienes-nacional').parent().hide();
                }
        });
JS;
    $this->registerJs($script);

/*        echo '<label class="cbx-label" for="s_2">Left</label>';
        echo CheckboxX::widget([
            'name'=>'s_2',
            'value'=>1,
            'options'=>['id'=>'s_2']
        ]);*/
    ?>
<!--
    <?/*= $form->field($model, 'sys_tipo_bien_id')->textInput() */?>

    <?/*= $form->field($model, 'principio_contable')->textInput() */?>

    <?/*= $form->field($model, 'depreciable')->checkbox() */?>

    <?/*= $form->field($model, 'deterioro')->checkbox() */?>

    <?/*= $form->field($model, 'detalle')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'origen')->textInput(['maxlength' => true]) */?>

    <?/*= $form->field($model, 'fecha_origen')->textInput() */?>

    <?/*= $form->field($model, 'contratista_id')->textInput() */?>

    <?/*= $form->field($model, 'propio')->checkbox() */?>

    <?/*= $form->field($model, 'sys_status')->checkbox() */?>

    <?/*= $form->field($model, 'sys_creado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_actualizado_el')->textInput() */?>

    <?/*= $form->field($model, 'sys_finalizado_el')->textInput() */?>
    -->
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['id'=>'crear','class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
