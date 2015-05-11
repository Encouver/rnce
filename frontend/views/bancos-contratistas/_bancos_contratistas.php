<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysBancos;
use wbraganca\dynamicform\DynamicFormWidget;
/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bancos-contratistas-form">

    <?php $form = ActiveForm::begin([
        'id' => "b_contratista",
  

]); ?>
    <div id="output6"></div>
    
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
                'model' => $banco_contratista[0],
                'formId' => 'b_contratista',
                'formFields' => [
                    'banco_id',
                    'num_cuenta',
                    'tipo_moneda',
                    'tipo_cuenta',
                    'estatus_cuenta',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($banco_contratista as $i => $carga_banco): ?>
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
                        <?php
                            // necessary for update action.
                            if (! $carga_banco->isNewRecord) {
                                echo Html::activeHiddenInput($carga_banco, "[{$i}]id");
                            }
                        ?>
                      
                     
                             <div class="col-sm-12">
                              <?= $form->field($carga_banco, "[{$i}]banco_id")->dropDownList(
                                ArrayHelper::map(SysBancos::find()->all(),'id','nombre'),
                            ['prompt' => 'Seleccione Banco'] 
                            ) ?>
                                 </div>
                            <div class="col-sm-12">
                                <?= $form->field($carga_banco, "[{$i}]num_cuenta")->textInput() ?>
                            </div>
                            <div class="col-sm-12">
                             <?= $form->field($carga_banco, "[{$i}]tipo_moneda")->dropDownList([ 'BOLIVARES' => 'BOLIVARES', 'DOLARES' => 'DOLARES', 'EUROS' => 'EUROS', ], ['prompt' => '']) ?>
                            </div>
                            <div class="col-sm-12">
                               <?= $form->field($carga_banco, "[{$i}]tipo_cuenta")->dropDownList([ 'CUENTA CORRIENTE' => 'CUENTA CORRIENTE', 'CUENTA CORRIENTE CON INTERESES / REMUNERADA' => 'CUENTA CORRIENTE CON INTERESES / REMUNERADA', 'CUENTA DE AHORROS' => 'CUENTA DE AHORROS', 'CUENTA EN MONEDA EXTRANGERA' => 'CUENTA EN MONEDA EXTRANGERA', ], ['prompt' => '']) ?>
                            </div>
                          <div class="col-sm-12">
                               <?= $form->field($carga_banco, "[{$i}]estatus_cuenta")->dropDownList([ 'ACTIVA' => 'ACTIVA', 'INACTIVA' => 'INACTIVA', ], ['prompt' => '']) ?>
                            </div>
                          
                     
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    
    
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar5']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar5').click(function(e){
          
            if($('form#b_contratista').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#b_contratista').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=bancos-contratistas/bancocontratista',
                    type: 'post',
                    data: $('form#b_contratista').serialize(),
                    success: function(data) {
                             $( "#output6" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


