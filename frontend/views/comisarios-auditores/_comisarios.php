<?php


use yii\jui\DatePicker;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use common\models\p\PersonasNaturales;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$url = \yii\helpers\Url::to(['sys-naturales-juridicas/naturaljuridicalist']);
$url2 = \yii\helpers\Url::to(['personas-naturales/crearcomisario']);
$url3 = \yii\helpers\Url::to(['comisarios-auditores/comisario']);
$persona_natural = new PersonasNaturales();
$persona = empty($model->natural_juridica_id) ? '' : City::findOne($model->natural_juridica_id)->denominacion;




?>
<div class="col-sm-12">
    
    <?php  Modal::begin([
    'options'=>['id'=>'m1_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar persona natural', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
]);?>
    <?php $form2 = ActiveForm::begin(['id'=>'modal_pnatural', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <?= $form2->field($persona_natural, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form2,
    'columns'=>2,
    'attributes'=>$persona_natural->formAttribs
      ]); ?>

    <div id="output15"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar15']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>
<div class="col-sm-9" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'c_comisarios',
        'type'=>ActiveForm::TYPE_VERTICAL
  ]); ?>
    
     
 
<?= $form->field($comisario, 'natural_juridica_id')->widget(Select2::classname(), [
     'initValueText' => $persona, // set the initial display text
    'options' => ['placeholder' => 'Numero de identificacion ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term,juridica:false}; }')
        ],
       'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
        'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
    ],
]);?>
     <?php echo Form::widget([
    'model'=>$comisario,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$comisario->formAttribs
      ]); ?>
    
  
     
    
    <div id="output17"></div>
      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar17']) ?> 
    </div>
    <?php ActiveForm::end(); ?>
    
    
    
    
    

   <?php
$script = <<< JS
    $('#enviar15').click(function(e){
          
            if($('form#modal_pnatural').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#modal_pnatural').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url2',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
                    }
                });
                
            }
    });
     $('#enviar17').click(function(e){
          
            if($('form#c_comisarios').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#c_comisarios').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url3',
                    type: 'post',
                    data: $('form#c_comisarios').serialize(),
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
<div class="col-md-12">
    
  
       <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'natural_juridica_id',
             'tipo_profesion',
            'colegiatura',
            'fecha_carta',
            'fecha_vencimiento',
            //'declaracion_jurada:boolean',
            // 'documento_registrado_id',
            // 'contratista_id',
            // 'comisario:boolean',
            // 'sys_status:boolean',
            // 'sys_creado_el',
            // 'sys_actualizado_el',
            // 'sys_finalizado_el',
            // 'auditor:boolean',
            // 'responsable_contabilidad:boolean',
            // 'informe_conversion:boolean',
        

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


