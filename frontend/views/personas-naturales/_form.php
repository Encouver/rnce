<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'type'=>ActiveForm::TYPE_VERTICAL, 'options' => ['data-pjax' => Yii::$app->request->isPjax]]);  ?>
     <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
    ?>
    <?php echo Form::widget([
                'model'=>$model,
                'form'=>$form,
                'columns'=>3,
                'attributes'=>$model->getformAttribs()
            ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php

$script = <<< JS
$( document ).ready(function() {
  
    
    $('.field-personasnaturales-sys_pais_id').css('display','none');
    $('.field-personasnaturales-rif').css('display','none');
    $('.field-personasnaturales-numero_identificacion').css('display','none');
        
    $('#personasnaturales-nacionalidad').click(function(e){
                if($('#personasnaturales-nacionalidad').val()=='NACIONAL') {
                     $('.field-personasnaturales-rif').css('display','inherit');
                     $('.field-personasnaturales-sys_pais_id').css('display','none');
                     $('.field-personasnaturales-numero_identificacion').css('display','none');
                     $('#personasnaturales-sys_pais_id').val('');
                     $('#personasnaturales-numero_identificacion').val('');
                  
                }else{
                        if($('#personasnaturales-nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasnaturales-rif').css('display','none');
                        $('.field-personasnaturales-sys_pais_id').css('display','inherit');
                        $('.field-personasnaturales-numero_identificacion').css('display','inherit');
                        $('#personasnaturales-rif').val('');
            
                        }
                     
                       }
                
       
        });
      
});
JS;
$this->registerJs($script);
?>

</div>
