<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
$urlPersona = Url::to(['personas-naturales/create']);

/* @var $model common\models\p\ComisariosAuditores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comisarios-auditores-form">
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

   <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
     <?= $form->field($model, 'comisario')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'auditor')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'responsable_contabilidad')->hiddenInput()->label(false) ?>
    <?= $form->field($model, 'informe_conversion')->hiddenInput()->label(false) ?>
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs($model->getScenario())
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
});
JS;
$this->registerJs($script);
?>

</div>
