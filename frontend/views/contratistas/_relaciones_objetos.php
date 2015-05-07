<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use common\models\p\SysPaises;
//use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-form">

    <?php $form = ActiveForm::begin(['id' => 'r_objetos']); ?>
      
     
   
    
   
    
    <div class="panel panel-default">
 
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $relacion_objeto[0],
                'formId' => 'r_objetos',
                'formFields' => [
                    'tipo_objeto',
                    'productos',
                    'marcas',
                    'domicilio_fabricante_id',
                    'denominacion',
                    'numero_identificacion',
                    'origen_producto_id',
                    'sello_firma',
                    'documento_traducido',
                    'idioma_redaccion_id',
                    'nombre_interprete',
                    'traductor_identificacion',
                    'fecha_emision',
                    'fecha_vencimiento'],
            ]); ?>
    <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($relacion_objeto as $i => $carga_autorizacion): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Autorizaciones</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      
                             
                        <div class="col-sm-12">
                             <?= $form->field($carga_autorizacion, "[{$i}]tipo_objeto")->dropDownList($autorizado, ['prompt' => '']) ?>

                            

                        </div>
                        <div class="col-sm-12">
                              <?= $form->field($carga_autorizacion, "[{$i}]domicilio_fabricante_id")->dropDownList(
                                    ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),
                                        ['prompt' => 'Seleccione Pais'] 
                                    ) ?>
                                 </div>
                            
                                <div class="col-sm-12">
                            
                          <?= $form->field($carga_autorizacion, "[{$i}]denominacion")->textInput() ?>
                        </div>
                        <div class="col-sm-12">
                            
                              <?= $form->field($carga_autorizacion, "[{$i}]numero_identificacion")->textInput() ?>
                        </div>
                                           
                        <div class="col-sm-12">
                            
                           <?= $form->field($carga_autorizacion, "[{$i}]productos")->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                               <?= $form->field($carga_autorizacion, "[{$i}]marcas")->textarea(['rows' => 6]) ?>
                            
                        </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_autorizacion, "[{$i}]origen_producto_id")->dropDownList(
                                    ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),
                                        ['prompt' => 'Seleccione Pais'] 
                                    ) ?>
                        </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_autorizacion, "[{$i}]sello_firma")->checkbox() ?>
                        </div>
                        <div class="col-sm-12">
                            
                              <?= $form->field($carga_autorizacion, "[{$i}]documento_traducido")->checkbox() ?>
                        </div>
                        <div class="col-sm-12">
                            
                                 <?= $form->field($carga_autorizacion, "[{$i}]idioma_redaccion_id")->dropDownList(
                                    ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),
                                        ['prompt' => 'Seleccione Pais'] 
                                    ) ?>
                        </div> 
                        <div class="col-sm-12">
                            
                            
                              <?= $form->field($carga_autorizacion, "[{$i}]nombre_interprete")->textInput() ?>
                        </div>
                        
                          <div class="col-sm-12">
                            
                             <?= $form->field($carga_autorizacion, "[{$i}]traductor_identificacion") ?>
                        </div>
                       
                        <div class="col-sm-12">
                            <?= $form->field($carga_autorizacion, "[{$i}]fecha_emision")->widget(
                                DatePicker::className(), [
                             // inline too, not bad
                            //'inline' => false,
                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                                ]
                                ]);?>
                            
                                 
                        </div> 
                       <div class="col-sm-12">
                            <?= $form->field($carga_autorizacion, "[{$i}]fecha_vencimiento")->widget(
                                DatePicker::className(), [
                             // inline too, not bad
                            //'inline' => false,
                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd'
                                ]
                                ]);?>
                           
                                 
                        </div> 
                        
                    </div>
                </div>
            <?php endforeach; ?>
            <br>
    
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar11']) ?> 
    </div>
    <?php ActiveForm::end(); ?>
    
       <div id="output11"></div>
     <?php
$script = <<< JS
    $('#enviar11').click(function(e){
          
            if($('form#r_objetos').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#r_objetos').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/objetoautorizacion',
                    type: 'post',
                    data: $('form#r_objetos').serialize(),
                    success: function(data) {
                             $( "#output11" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>
