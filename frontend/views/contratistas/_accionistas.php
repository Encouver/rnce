<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use yii\bootstrap\Modal;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$natural_juridica = new SysNaturalesJuridicas();
$persona_juridica = new PersonasJuridicas();
$url = \yii\helpers\Url::to(['naturaljuridicalist']);
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
        
$data = [
 'PROVEEDOR'=> ['PRODUCTOR'=>'PRODUCTOR', 'FABRICANTE'=>'FABRICANTE','FABRICANTE IMPORTADOR'=>'FABRICANTE IMPORTADOR', 'DISTRIBUIDOR'=>'DISTRIBUIDOR','DISTRIBUIDOR AUTORIZADO'=>'DISTRIBUIDOR AUTORIZADO','DISTRIBUIDOR IMPORTADOR'=>'DITRIBUIDOR IMPORTADOR','DISTRIBUIDOR IMPORTADOR AUTORIZADO'=>'DISTRIBUIDOR IMPORTADOR AUTORIZADO'],
 'SERVICIOS'=>['SERVICIOS BASICOS'=>'SERVICIOS BASICOS' ,'SERVICIOS PROFESIONALES'=>'SERVICIOS PROFESIONALES','SERVICIOS COMERCIALES'=>'SERVICIOS COMERCIALES','SERVICIOS COMERCIALES AUTORIZADO'=>'SERVICIOS COMERCIALES AUTORIZADO'],
 'OBRAS'=>['OBRAS' => "OBRAS",]
 ];
?>

<div class="contratista-drop" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'d_comercial'
  ]); ?>
    
    
<?= $form->field($natural_juridica, 'rif')->widget(Select2::classname(), [
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
    <?php ActiveForm::end(); ?>
    
  <?php  Modal::begin([
    'options'=>['id'=>'kartik'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Fabricante</h4>',
    'toggleButton' => ['label' => 'Agregar persona natural', 'class'=>'btn btn-lg btn-primary'],
]);?>
    <?php $form2 = ActiveForm::begin(['id'=>'modal_pnatural', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <div id="output"></div>
    
    
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
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-naturales/crearpersonanatural',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
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


