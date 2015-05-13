<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
$url = \yii\helpers\Url::to(['duraciones-empresas/duracionacta']);
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-actas-form col-sm-9">

    <?php $form = ActiveForm::begin(['id'=>'d_actas']); ?>
    

 <?php echo Form::widget([
    'model'=>$duracion_empresa,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$duracion_empresa->formAttribs
      ]); ?>
     <div id="output17"></div>
     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
       <?php
$script = <<< JS
   
     $('#enviar').click(function(e){
          
            if($('form#d_actas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#d_actas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#d_actas').serialize(),
                    success: function(data) {
                             $( "#output17" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
</div>
