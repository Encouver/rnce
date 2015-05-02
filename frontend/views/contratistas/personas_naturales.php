<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin([
        'id' => "raul",
     //'action' => ['contratistas/datosbasicos'],

]); ?>
    <div id="output"></div>
    <?= $form->field($natural_juridica, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($persona_natural, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>
     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar').click(function(e){
          
            if($('form#raul').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#raul').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/datosnatural',
                    type: 'post',
                    data: $('form#raul').serialize(),
                    success: function(data) {
                             $( "#output" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


