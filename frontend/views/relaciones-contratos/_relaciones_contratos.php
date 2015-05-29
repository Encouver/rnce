<?php


use yii\jui\DatePicker;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\p\PersonasJuridicas;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$urlJuridica = Url::to(['personas-juridicas/create']);
$url3 = Url::to(['relaciones-contratos/relacioncontrato']);      
?>
<div class="col-sm-12" style="margin-bottom: 10px;">
    
   <?php  Modal::begin([
    'options'=>['id'=>'persona_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Juridica', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-documento2">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form3 = ActiveForm::begin(['id'=>$modelJuridica->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlJuridica, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelJuridica,
                'form'=>$form3,
                'columns'=>3,
                'attributes'=>$modelJuridica->getformAttribs()
            ]); ?>

        <!--    <div class="form-group">
                <?/*= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar-documento']) */?>
            </div>-->
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?>  
    <?php $form = ActiveForm::begin([
        'id'=>'r_contratos',
        'type'=>ActiveForm::TYPE_VERTICAL
  ]); ?>
    
     <?php echo Form::widget([
    'model'=>$relacion_contrato,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$relacion_contrato->formAttribs
      ]); ?>
    
    <div id="output"></div>

        <div id="output17"></div>
      
    <?php ActiveForm::end(); ?>
     

   
    
      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar17']) ?> 
    </div>

   <?php
$script = <<< JS
       $( document ).ready(function() {
  
        
        $('.field-personasjuridicas-sys_pais_id').css('display','none');
    $('.field-personasjuridicas-rif').css('display','none');
    $('.field-personasjuridicas-numero_identificacion').css('display','none');
        
    $('#personasjuridicas-tipo_nacionalidad').click(function(e){
                if($('#personasjuridicas-tipo_nacionalidad').val()=='NACIONAL') {
                     $('.field-personasjuridicas-rif').css('display','inherit');
                     $('.field-personasjuridicas-sys_pais_id').css('display','none');
                     $('.field-personasjuridicas-numero_identificacion').css('display','none');
                     $('#personasjuridicas-sys_pais_id').val('');
                     $('#personasjuridicas-numero_identificacion').val('');
                  
                }else{
                        if($('#personasjuridicas-tipo_nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasjuridicas-rif').css('display','none');
                        $('.field-personasjuridicas-sys_pais_id').css('display','inherit');
                        $('.field-personasjuridicas-numero_identificacion').css('display','inherit');
                        $('#personasjuridicas-rif').val('');
            
                        }
                     
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
      
});
JS;
$this->registerJs($script);
?>
        
  
</div>


