<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model common\models\p\FondosEmergencias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fondos-emergencias-form">

     <?php $form = ActiveForm::begin(); ?>

    <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>4,
    'attributes'=>$model->getFormAttribs()
      ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    <?php

$script = <<< JS
$( document ).ready(function() {
        
    $('.field-fondosemergencias-monto_asociados').css('display','none');
    $('.field-fondosemergencias-corto_plazo').css('display','none');
     $('.field-fondosemergencias-interes').css('display','none');
    $('.field-fondosemergencias-numero_plazo').css('display','none');
    $('.field-fondosemergencias-tasa_interes').css('display','none');
        
   
     
        if($('#fondosemergencias-monto_actual').val()>0){
                    $('.field-fondosemergencias-monto_asociados').css('display','inherit');
                    $('.field-fondosemergencias-corto_plazo').css('display','inherit');
                    $('.field-fondosemergencias-interes').css('display','inherit');
                    $('.field-fondosemergencias-numero_plazo').css('display','inherit');
                    $('.field-fondosemergencias-tasa_interes').css('display','inherit');
                   
        }

    
        $('#fondosemergencias-monto_actual').change(function(e){
              
                if($('#fondosemergencias-monto_actual').val()>0){
                    $('.field-fondosemergencias-monto_asociados').css('display','inherit');
                    $('.field-fondosemergencias-corto_plazo').css('display','inherit');
                    $('.field-fondosemergencias-interes').css('display','inherit');
                    $('.field-fondosemergencias-numero_plazo').css('display','inherit');
                    $('.field-fondosemergencias-tasa_interes').css('display','inherit');
                   
                }else{
                        $('.field-fondosemergencias-monto_asociados').css('display','none');
                        $('.field-fondosemergencias-corto_plazo').css('display','none');
                        $('.field-fondosemergencias-interes').css('display','none');
                        $('.field-fondosemergencias-numero_plazo').css('display','none');
                        $('.field-fondosemergencias-tasa_interes').css('display','none');
                    
                    }
       
        });
      
});
JS;
$this->registerJs($script);
?>