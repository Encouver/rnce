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


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$url = \yii\helpers\Url::to(['accionistas-otros/naturaljuridicalist']);
$persona_natural = new PersonasNaturales();


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
<div class="col-md-12">
    
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
<div class="contratista-drop" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'a_otros'
  ]); ?>
    
     
 
<?= $form->field($comisario, 'natural_juridica_id')->widget(Select2::classname(), [
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
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-naturales/crearcomisario',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
                    }
                });
                
            }
    });
     $('#enviar17').click(function(e){
          
            if($('form#a_otros').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#a_otros').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=accionistas-otros/crearaccionista',
                    type: 'post',
                    data: $('form#a_otros').serialize(),
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


