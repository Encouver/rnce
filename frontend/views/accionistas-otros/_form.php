<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use yii\helpers\Url;
use yii\widgets\Pjax;
$urlPersona = Url::to(['personas-naturales/create']);
$urlJuridica = Url::to(['personas-juridicas/create']);

/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */
/* @var $form yii\widgets\ActiveForm */

$persona_juridica = new PersonasJuridicas();
?>



<div class="accionistas-otros-form">
    <?php  Modal::begin([
    'options'=>['id'=>'persona_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Natural', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-documento">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelPersona->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlPersona, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelPersona,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelPersona->getformAttribs("basico")
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
 <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs()
      ]); ?>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
 <?php
$script = <<< JS
        $( document ).ready(function() {
  
    
    $('.field-personasnaturales-sys_pais_id').css('display','none');
    $('.field-personasnaturales-rif').css('display','none');
    $('.field-personasnaturales-numero_identificacion').css('display','none');
        
    $('#personasnaturales-nacionalidad').click(function(e){
                if($('#personasnaturales-nacionalidad').val()=='NACIONAL') {
                     $('.field-personasnaturales-rif').css('display','inherit');
                     $('.field-personasnaturales-sys_pais_id').css('display','none');
                     $('.field-personasnaturales-numero_identificacion').css('display','none');
                     $('#personasnaturales-sys_pais_id').val('');
                     $('#personasnaturales-numero_identificacion').val('');
                  
                }else{
                        if($('#personasnaturales-nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasnaturales-rif').css('display','none');
                        $('.field-personasnaturales-sys_pais_id').css('display','inherit');
                        $('.field-personasnaturales-numero_identificacion').css('display','inherit');
                        $('#personasnaturales-rif').val('');
            
                        }
                     
                       }
                
       
        });
        
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
      
});
JS;
$this->registerJs($script);
?>

</div>
