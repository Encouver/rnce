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
use common\models\p\SysPaises;
use yii\helpers\ArrayHelper;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$natural_juridica = new SysNaturalesJuridicas();
$persona_juridica = new PersonasJuridicas();
$url = \yii\helpers\Url::to(['naturaljuridicalist']);
$persona_natural = new PersonasNaturales();
$accionista = new common\models\p\AccionistasOtros();


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
    
    
    <div id="output"></div>
         <?= $form2->field($persona_natural, 'sys_pais_id')->dropDownList(
                           ArrayHelper::map(SysPaises::find()->all(),'id','nombre'),
                                  ['prompt' => 'Seleccione Pais'] 
                               ) ?>
                          
    
    <?= $form2->field($persona_natural, 'numero_identificacion')->textInput(['maxlength' => 50]) ?>
    
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form2,
    'columns'=>2,
    'attributes'=>$persona_natural->formAttribs
      ]); ?>
      <?= $form2->field($persona_natural, 'estado_civil')->dropDownList([ 'SOLTERO (A)' => 'SOLTERO (A)', 'CASADO (A)' => 'CASADO (A)', 'CONCUBINO (A)' => 'CONCUBINO (A)', 'DIVORCIADO (A)' => 'DIVORCIADO (A)', 'VIUDO (A)' => 'VIUDO (A)', ], ['prompt' => 'Seleccione estado civil']) ?>

    <div id="output15"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar15']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
    
    
        
     
     <?php  Modal::begin([
    'options'=>['id'=>'m2_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar persona juridica', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
        ]);?>
    <?php $form3 = ActiveForm::begin(['id'=>'modal_pjuridica', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <div id="output"></div>
        <?= $form3->field($persona_juridica, 'tipo_nacionalidad')->dropDownList([ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ], ['prompt' => '']) ?>

    <?php echo Form::widget([
    'model'=>$persona_juridica,
    'form'=>$form3,
    'columns'=>2,
    'attributes'=>$persona_juridica->formAttribs
      ]); ?>
    
    <div id="output16"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar16']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>
<div class="contratista-drop" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'a_otros'
  ]); ?>
    
     
 
<?= $form->field($accionista, 'natural_juridica_id')->widget(Select2::classname(), [
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
    
    
     <?= $form->field($accionista, 'accionista')->checkbox() ?>
    <?= $form->field($accionista, 'porcentaje_accionario')->textInput() ?>
    <?= $form->field($accionista, 'junta_directiva')->checkbox() ?>
    <?= $form->field($accionista, 'cargo')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($accionista, 'rep_legal')->checkbox() ?>
    <?= $form->field($accionista, 'repr_legal_vigencia')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>
     
     <?= $form->field($accionista, 'tipo_obligacion')->dropDownList([ 'FIRMA CONJUNTA' => 'FIRMA CONJUNTA', 'FIRMA SEPARADA' => 'FIRMA SEPARADA', ], ['prompt' => '']) ?>
    
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
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-naturales/crearpersonanatural',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
                    }
                });
                
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
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=personas-juridicas/crearpersonajuridica',
                    type: 'post',
                    data: $('form#modal_pjuridica').serialize(),
                    success: function(data) {
                             $( "#output16" ).html( data ); 
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


