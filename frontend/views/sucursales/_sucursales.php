<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

    <?php $form = ActiveForm::begin([
        'id' => "r_sucursal",
  

]); ?>
    <div id="output5"></div>
    
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Bancos asociados</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $relacion_sucursal[0],
                'formId' => 'r_sucursal',
                'formFields' => [
                    'sys_estado_id',
                    'sys_municipio_id',
                    'sys_parroquia_id',
                    'zona',
                    'calle',
                    'casa',
                    'nivel',
                    'numero',
                    'referencia',
                    'rif',
                    'primer_nombre',
                    'segundo_nombre',
                    'primer_apellido',
                    'segundo_apellido',
                    'telefono_local',
                    'telefono_celular',
                    'fax',
                    'correo',
                    'pagina_web',
                    'instagram',
                    'representante',
                    'accionista'],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($relacion_sucursal as $i => $carga_sucursal): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Address</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                      
                         <div class="col-sm-12">
                            <h3>Direccion de la sucursal</h3>
                        </div>
                             <div class="col-sm-12">
                              <?= $form->field($carga_sucursal, "[{$i}]sys_estado_id")->dropDownList(
                                    ArrayHelper::map(SysEstados::find()->all(),'id','nombre'),
                                        ['prompt' => 'Seleccione Estado'] 
                                    ) ?>
                                 </div>
                            <div class="col-sm-12">
                                  
                                <?= $form->field($carga_sucursal, "[{$i}]sys_municipio_id")->dropDownList(
                                ArrayHelper::map(SysMunicipios::find()->all(),'id','nombre'),
                                    ['prompt' => 'Seleccione Municipio'] 
                                    ) ?>
                            </div>
                            <div class="col-sm-12">
                             <?= $form->field($carga_sucursal, "[{$i}]sys_parroquia_id")->dropDownList(
                                    ArrayHelper::map(SysParroquias::find()->all(),'id','nombre'),
                                ['prompt' => 'Seleccione Parroquia'] 
                                ) ?>
                            </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_sucursal, "[{$i}]zona")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_sucursal, "[{$i}]calle")->textInput(['maxlength' => 255]) ?>

                        </div>
                        <div class="col-sm-12">
                            
                            <?= $form->field($carga_sucursal, "[{$i}]casa")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_sucursal, "[{$i}]nivel")->textInput(['maxlength' => 50]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                            
                            <?= $form->field($carga_sucursal, "[{$i}]numero")->textInput(['maxlength' => 20]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                            <?= $form->field($carga_sucursal, "[{$i}]referencia")->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="col-sm-12">
                            <h3>Persona de contacto</h3>
                        </div>
                        <div class="col-sm-12">
                            
                            <?= $form->field($carga_sucursal, "[{$i}]rif")->textInput(['maxlength' => 20]) ?>
                            
                        </div>
                        <div class="col-sm-12">
                             <?= $form->field($carga_sucursal, "[{$i}]primer_nombre")->textInput(['maxlength' => 255]) ?>
                            
                        </div>
                        <div class="col-sm-12">
                             <?= $form->field($carga_sucursal, "[{$i}]segundo_nombre")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            <?= $form->field($carga_sucursal, "[{$i}]primer_apellido")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                             <?= $form->field($carga_sucursal, "[{$i}]segundo_apellido")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                                    <?= $form->field($carga_sucursal, "[{$i}]telefono_local")->textInput(['maxlength' => 50]) ?>
                        </div>
                        <div class="col-sm-12">
                             <?= $form->field($carga_sucursal, "[{$i}]telefono_celular")->textInput(['maxlength' => 50]) ?>
                        </div>
                        <div class="col-sm-12">
                            <?= $form->field($carga_sucursal, "[{$i}]fax")->textInput(['maxlength' => 50]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                            <?= $form->field($carga_sucursal, "[{$i}]correo")->textInput(['maxlength' => 150]) ?>
                        </div>
                        <div class="col-sm-12">
                            <?= $form->field($carga_sucursal, "[{$i}]pagina_web")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                             <?= $form->field($carga_sucursal, "[{$i}]facebook")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            <?= $form->field($carga_sucursal, "[{$i}]twitter")->textInput(['maxlength' => 255]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                            <?= $form->field($carga_sucursal, "[{$i}]instagram")->textInput(['maxlength' => 255]) ?>
                        </div>
                         <div class="col-sm-12">
                            <h4>La persona de contacto debe ser el Representante Legal o Accionista</h4>
                        </div>
                        <div class="col-sm-6">
                             <?= $form->field($carga_sucursal, "[{$i}]representante")->checkbox() ?>
                        </div>
                        <div class="col-sm-6">
                                <?= $form->field($carga_sucursal, "[{$i}]accionista")->checkbox() ?>

                        </div>
                          
                     
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    
    
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar4']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar4').click(function(e){
          
            if($('form#r_sucursal').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#b_contratista').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=sucursales/relacionsucursal',
                    type: 'post',
                    data: $('form#r_sucursal').serialize(),
                    success: function(data) {
                             $( "#output5" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


