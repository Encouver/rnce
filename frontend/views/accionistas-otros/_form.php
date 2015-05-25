<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use common\models\p\PersonasNaturales;
use common\models\p\PersonasJuridicas;
use yii\bootstrap\Modal;
use kartik\builder\Form;
use common\models\p\SysPaises;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\p\AccionistasOtros */
/* @var $form yii\widgets\ActiveForm */

$persona_juridica = new PersonasJuridicas();
$persona_natural = new PersonasNaturales();   
?>
<div class="container">
    
    <?php  Modal::begin([
    'options'=>['id'=>'m1_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar persona natural', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
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
    'attributes'=>$persona_natural->getFormAttribs("basico2")
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
    'toggleButton' => ['label' => 'Agregar persona juridica', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
        ]);?>
    <?php $form3 = ActiveForm::begin(['id'=>'modal_pjuridica', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <div id="output"></div>
        <?= $form3->field($persona_juridica, 'tipo_nacionalidad')->dropDownList([ 'NACIONAL' => 'NACIONAL', 'EXTRANJERA' => 'EXTRANJERA', ], ['prompt' => '']) ?>

    <?php echo Form::widget([
    'model'=>$persona_juridica,
    'form'=>$form3,
    'columns'=>2,
    'attributes'=>$persona_juridica->getFormAttribs("posextranjero")
      ]); ?>
    
    <div id="output16"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar16']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>



<div class="accionistas-otros-form">
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
JS;
$this->registerJs($script);

?>
</div>
