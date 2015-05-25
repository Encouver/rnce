<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use common\models\p\PersonasNaturales;
use yii\bootstrap\Modal;

$persona_natural = new PersonasNaturales();
$url2 = \yii\helpers\Url::to(['personas-naturales/crearcomisario']);
/* @var $this yii\web\View */
/* @var $model common\models\p\ComisariosAuditores */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modalpersona">
    
    <?php  Modal::begin([
    'options'=>['id'=>'m1_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar persona natural', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>
    <?php $form2 = ActiveForm::begin(['id'=>'modal_pnatural', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form2,
    'columns'=>2,
    'attributes'=>$persona_natural->getFormAttribs("basico")
      ]); ?>

    <div id="output15"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar15']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>
<div class="comisarios-auditores-form">

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
JS;
$this->registerJs($script);

?>

</div>
