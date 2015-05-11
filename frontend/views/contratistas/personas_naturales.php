<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="col-sm-8 personas-naturales-form">

    <?php $form = ActiveForm::begin(['id'=>'raul', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
    <div id="output"></div>
    
    
    <?= $form->field($natural_juridica, 'rif')->textInput(['maxlength' => 50])?>
    
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$persona_natural->formAttribs
      ]); ?>
    
   
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


