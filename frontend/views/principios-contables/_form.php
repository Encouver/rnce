<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\PrincipiosContables */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="principios-contables-form">

      <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs()
      ]); ?>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php

$script = <<< JS
$( document ).ready(function() {
  
     if(window.location.href.indexOf("update") > -1)
    {
 
         if($('#principioscontables-principio_contable').val()=='EMPRESA DE SEGUROS') {
                     $('.field-principioscontables-codigo_sudeaseg').css('display','inherit');
                  
                }
    }else {
    $('.field-principioscontables-codigo_sudeaseg').css('display','none');
        } 
        $('#principioscontables-principio_contable').click(function(e){
                if($('#principioscontables-principio_contable').val()=='EMPRESA DE SEGUROS') {
                     $('.field-principioscontables-codigo_sudeaseg').css('display','inherit');
                  
                }else{
                     $('.field-principioscontables-codigo_sudeaseg').css('display','none');
                     $('#principioscontables-codigo_sudeaseg').val('');
                       }
                
       
        });
      
});
JS;
$this->registerJs($script);
?>

</div>
