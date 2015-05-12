<?php


use yii\jui\DatePicker;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use common\models\p\PersonasJuridicas;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use wbraganca\dynamicform\DynamicFormWidget;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$url = \yii\helpers\Url::to(['accionistas-otros/naturaljuridicalist']);
$persona_juridica = new PersonasJuridicas();



$initScript = <<< SCRIPT
function (element, callback) {
    var id=\$(element).val();
    if (id !== "") {
        \$.ajax("{$url}?id=" + id, {
            dataType: "json"
        }).done(function(data) { callback(data.results);});
    }
}
SCRIPT;
        
?>
<div class="col-sm-12">
    
     
     <?php  Modal::begin([
    'options'=>['id'=>'m2_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar persona juridica', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
        ]);?>
    <?php $form3 = ActiveForm::begin(['id'=>'modal_pjuridica', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    <?php echo Form::widget([
    'model'=>$persona_juridica,
    'form'=>$form3,
    'columns'=>2,
    'attributes'=>$persona_juridica->formAttribsnacional
      ]); ?>
    
    <div id="output16"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar16']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>
<div class="col-sm-9" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'r_contratos',
        'type'=>ActiveForm::TYPE_VERTICAL
  ]); ?>
    
     
 
<?= $form->field($relacion_contrato, 'natural_juridica_id')->widget(Select2::classname(), [
    'options' => ['placeholder' => 'Numero de identificacion ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(term,page) { return {search:term}; }'),
            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
        ],
        'initSelection' => new JsExpression($initScript)
    ],
]);?>
     <?php echo Form::widget([
    'model'=>$relacion_contrato,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$relacion_contrato->formAttribs
      ]); ?>
    
  
      <div id="output"></div>
      
      
       <div class="panel panel-default hide" id="formfactura">
        <div class="panel-heading"><h4>Facturas</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 10, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $contrato_factura[0],
                'formId' => 'r_contratos',
                'formFields' => [
                    'orden_factura',
                    'monto',
                    
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($contrato_factura as $i => $carga_factura): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                     
                     
                            
                            <div class="col-sm-6">
                                <?= $form->field($carga_factura, "[{$i}]orden_factura")->textInput() ?>
                            </div>
                               
                            <div class="col-sm-6">
                                <?= $form->field($carga_factura, "[{$i}]monto")->textInput() ?>
                            </div>
                            
                     
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
      
      
      
    
    <div id="output17"></div>
      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar17']) ?> 
    </div>
    <?php ActiveForm::end(); ?>
    
    
    

   <?php
$script = <<< JS
        
        
        
         $('select#relacionescontratos-tipo_contrato').change(function(e){

            if($(this).val()=="SERVICIOS"){
                $('#formfactura').removeClass("hide");
            }
            
    });
        
    $('#enviar16').click(function(e){
          
            if($('form#modal_pjuridica').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#modal_pjuridica').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-juridicas/crearpersonajuridicanacional',
                    type: 'post',
                    data: $('form#modal_pjuridica').serialize(),
                    success: function(data) {
                             $( "#output16" ).html( data ); 
                    }
                });
                
            }
    });
     $('#enviar17').click(function(e){
          
            if($('form#r_contratos').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#r_contratos').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=relaciones-contratos/relacioncontrato',
                    type: 'post',
                    data: $('form#r_contratos').serialize(),
                    success: function(data) {
                             $( "#output17" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
<!--    <div class="form-group centered">
         <?/*= Html::Button(Yii::t('app', 'Seleccionar'), ['class' => 'btn btn-success', 'id' => 'enviar8']) */?>
    </div>
-->
    
  
</div>


