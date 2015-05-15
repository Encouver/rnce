<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */


$url = \yii\helpers\Url::to(['contratistas/datosjuridica']);
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin([
        'id' => "p_juridica",
  

]); ?>
    <div id="output2"></div>
    <?= $form->field($natural_juridica, 'rif')->textInput(['maxlength' => 50]) ?>
     <?= $form->field($natural_juridica, 'denominacion')->textInput(['maxlength' => 50]) ?>   
      <?= $form->field($contratista, 'sigla')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($contratista, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ], ['prompt' => '']) ?>
    
     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar').click(function(e){
          
            if($('form#p_juridica').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#p_juridica').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#p_juridica').serialize(),
                    success: function(data) {
                             $( "#output2" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


