<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$url = \yii\helpers\Url::to(['contratistas-contactos/personacontacto']);
/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin([
        'id' => "p_contacto",
  

]); ?>
    <div id="output4"></div>
    <?= $form->field($persona_natural, 'rif')->textInput(['maxlength' => 20]) ?>
    
     <?= $form->field($persona_natural, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'telefono_local')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($persona_natural, 'telefono_celular')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($persona_natural, 'fax')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($persona_natural, 'correo')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($persona_natural, 'pagina_web')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'facebook')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'twitter')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'instagram')->textInput(['maxlength' => 255]) ?>
    

     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar3']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar3').click(function(e){
          
            if($('form#p_contacto').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#p_contacto').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#p_contacto').serialize(),
                    success: function(data) {
                             $( "#output4" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


