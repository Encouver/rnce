<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Modal;
use common\models\p\SysNaturalesJuridicas;
use common\models\p\PersonasJuridicas;
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */

$persona_juridica = new PersonasJuridicas();
?>

<div class="objetos-autorizaciones-form">
    
     <?php  Modal::begin([
    'options'=>['id'=>'m2_juridica'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Juridica</h4>',
    'toggleButton' => ['label' => 'Agregar fabricante', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
        ]);?>
        <?php $form3 = ActiveForm::begin(['id'=>'modal_pjuridica', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
        <div id="output"></div>
        <?php echo Form::widget([
        'model'=>$persona_juridica,
        'form'=>$form3,
        'columns'=>2,
        'attributes'=>$persona_juridica->getFormAttribs("posextranjero")
        ]); ?>
    
         <div id="output16"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar2']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
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
     $('#enviar2').click(function(e){
          
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
