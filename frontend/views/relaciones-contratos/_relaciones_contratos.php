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

$url = \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']);
$url2 = \yii\helpers\Url::to(['personas-juridicas/crearpersonajuridicanacional']);
$url3 = \yii\helpers\Url::to(['relaciones-contratos/relacioncontrato']);
$persona_juridica = new PersonasJuridicas();

$persona = empty($model->natural_juridica_id) ? '' : \common\models\p\SysNaturalesJuridicas::findOne($model->natural_juridica_id)->denominacion;

        
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
    
    <div id="output16">
        
    </div>
    
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
    'initValueText' => $persona, // set the initial display text
    'options' => ['placeholder' => 'Numero de identificacion ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
       'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
        'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
    ],
]);?>
     <?php echo Form::widget([
    'model'=>$relacion_contrato,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$relacion_contrato->formAttribs
      ]); ?>
    
  
      
    <?php ActiveForm::end(); ?>
       <div id="output"></div>

        <div id="output17"></div>

   
    
      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar17']) ?> 
    </div>

   <?php
$script = <<< JS
        
        
        
       
    $('#enviar16').click(function(e){
          
            if($('form#modal_pjuridica').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#modal_pjuridica').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url2',
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
            var fa = $('form#r_contratos').serialize();
        
            if($('#relacionescontratos-tipo_contrato').val()=="OBRAS"){
             
                var fb = $('form#c_valuaciones').serialize();
            }else{
                 var fb = $('form#c_facturas').serialize();
            }
            //var fb = $('form#c_facturas').serialize();
                //$('form#r_contratos').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url3',
                    type: 'post',
                    data: fa+ '&' + fb,
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


