<?php

use kartik\builder\Form;
use kartik\popover\PopoverX;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\a\ActivosBienes */
/* @var $modelDatosImportacion common\models\a\ActivosDatosImportaciones */


/* @var $form yii\widgets\ActiveForm */
?>

<div class="activos-bienes-form">
<?php
$urlFactura = Url::to(['activos-facturas/create-ajax']);

$urlDocumento = Url::to(['activos-documentos-registrados/create']);

?>


<?php  Modal::begin([
    'options'=>['id'=>'m1_factura'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Factura</h4>',
    'toggleButton' => ['label' => 'Agregar Factura', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<?php $form2 = ActiveForm::begin(['id'=>$modelFactura->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlFactura]); ?>

    <?php echo Form::widget([
        'model'=>$modelFactura,
        'form'=>$form2,
        'columns'=>3,
        'attributes'=>$modelFactura->formAttribs
    ]); ?>

    <div class="form-group">
        <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-factura']) ?>
    </div>
<div id="output-factura">
</div>
<?php ActiveForm::end(); ?>

<?php Modal::end();?>




<?php  Modal::begin([
    'options'=>['id'=>'m1_documento'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Documento Registrado</h4>',
    'toggleButton' => ['label' => 'Agregar Documento Registrado', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
]);?>
<div id="output-documento">
    <?php $form2 = ActiveForm::begin(['id'=>$modelDocumento->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlDocumento]); ?>

    <?php echo Form::widget([
        'model'=>$modelDocumento,
        'form'=>$form2,
        'columns'=>3,
        'attributes'=>$modelDocumento->formAttribs
    ]); ?>

<!--    <div class="form-group">
        <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
    </div>-->
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Enviar') , ['class' =>'btn btn-success' ]) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<?php Modal::end();?>

<!--
<div id="output-documento">
    <?php /*$form2 = ActiveForm::begin(['id'=>'modal_documento', 'type'=>ActiveForm::TYPE_VERTICAL]); */?>
    <?php
/*
    PopoverX::begin([
        'placement' => PopoverX::ALIGN_BOTTOM_LEFT,
        'size'=>'lg',
        'toggleButton' => ['label'=>'Agregar Documento Registrado', 'class'=>'btn btn-default'],
        'header' => '<i class="glyphicon glyphicon-lock"></i> Documento Registrado',
        'footer'=>Html::submitButton('Enviar', ['id'=>'enviar-documento', 'class'=>'btn btn-sm btn-primary']) .
            Html::resetButton('Resetear', ['class'=>'btn btn-sm btn-default'])
    ]);
    */?>
    <?php /*echo Form::widget([
        'model'=>$modelDocumento,
        'form'=>$form2,
        'columns'=>3,
        'attributes'=>$modelDocumento->formAttribs
    ]); */?>
    <?php
/*    PopoverX::end();

    */?>

</div>
<?php /*ActiveForm::end(); */?>

    -->

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
            if ($model->sys_tipo_bien_id == 3)
                echo Form::widget([       // 3 column layout
                    'model' => $modelVehiculo,
                    'form' => $form,
                    'columns' => 4,
                    'columnSize' => 'xs',
                    'attributes' => $modelVehiculo->getFormAttribs()
                ]);
            if ($model->sys_tipo_bien_id == 15)
                echo Form::widget([       // 3 column layout
                    'model' => $modelLicencia,
                    'form' => $form,
                    'columns' => 4,
                    'columnSize' => 'xs',
                    'attributes' => $modelLicencia->getFormAttribs()
                 ]);
        }

        //if($model->factura) {
            echo '<div id="factura-container" style="display: none;">';
            echo '<h2> Datos de la Factura: </h2>';
   /*         echo Form::widget([       // 3 column layout
                'model' => $modelFactura,
                'form' => $form,
                'columns' => 4,
                'columnSize' => 'xs',
                'attributes' => $modelFactura->getFormAttribs($model)
            ]);*/
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

$('form#{$modelDocumento->formName()}').on('beforeSubmit', function(e){
        var \$form = $(this);
        $.post(
            \$form.attr("action"), // serialize Yii2 form
            \$form.serialize()
        )
        .done(function(result){
            if(result == 1)
            {
                $(\$form).trigger("reset");

            }else{
            alert('Error');

            }
            $("#message").html(result.message);
        }).fail(function(){
            console.log("server errror");
        });
    });

    $('#enviar-documento').click(function(e){

        if($('form#modal_documento').find('.has-error').length!=0){

            return false;
        }else
        {
            //$('form#modal_pnatural').submit();
            //e.preventDefault();
            //e.stopImmediatePropagation();
       /*     $.ajax({

                    url: '$urlDocumento',
                    type: 'post',
                    data: $('form#modal_documento').serialize(),
                    success: function(data) {
                    $( "#output-documento" ).html( data );
                }
                });*/

            }
    });

    $('form#{$modelFactura->formName()}').on('beforeSubmit', function(e){
        var \$form = $(this);
        $.post(
            \$form.attr("action"), // serialize Yii2 form
            \$form.serialize()
        )
        .done(function(result){
            if(result == 1)
            {
                $(\$form).trigger("reset");

            }else{
            alert('Error');

            }
            $("#message").html(result.message);
        }).fail(function(){
            console.log("server errror");
        });
    });

    $('#enviar-factura').click(function(e){

        if($('form#modal_factura').find('.has-error').length!=0){
            alert('Revise el formulario.');
            return false;
        }else
        {
            //$('form#modal_pnatural').submit();
            e.preventDefault();
            e.stopImmediatePropagation();
            $.ajax({

                    url: '$urlFactura',
                    type: 'post',
                    data: $('form#modal_factura').serialize(),
                    success: function(data) {
                    $( "#output-factura" ).html( data );
                }
                });

            }
    });

    function datosImportados(){
            if($('#activosbienes-nacional').is(':checked') ){
               $('#datos-importacion-container').hide();
            }//alert($('#activosbienes-nacional').val());
            if(!$('#activosbienes-nacional').is(':checked')){
                 $('#datos-importacion-container').show();
        }
    }
     $('#activosbienes-nacional').change(function(e){

               datosImportados();
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
