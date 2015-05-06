<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-form">

    <?php $form = ActiveForm::begin(['id' => 'o_autorizaciones']); ?>
    
   
    
    
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
                'model' => $objeto_autorizacion[0],
                'formId' => 'o_autorizaciones',
                'formFields' => [
                    'tipo_objeto',
                    'productos',
                    'marcas'],
            ]); ?>
    <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($objeto_autorizacion as $i => $carga_autorizacion): ?>
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
                            
                           <?= $form->field($carga_autorizacion, "[{$i}]productos")->textarea(['rows' => 6]) ?>
                        </div>
                        <div class="col-sm-12">
                            
                               <?= $form->field($carga_autorizacion, "[{$i}]marcas")->textarea(['rows' => 6]) ?>
                            
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
          
            if($('form#o_autorizaciones').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#o_autorizaciones').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/objetoautorizacion',
                    type: 'post',
                    data: $('form#o_autorizaciones').serialize(),
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
