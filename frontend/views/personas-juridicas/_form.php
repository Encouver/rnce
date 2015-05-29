<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasJuridicas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-juridicas-form">


  
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
  
    
    $('.field-personasjuridicas-sys_pais_id').css('display','none');
    $('.field-personasjuridicas-rif').css('display','none');
    $('.field-personasjuridicas-numero_identificacion').css('display','none');
        
    $('#personasjuridicas-tipo_nacionalidad').click(function(e){
                if($('#personasjuridicas-tipo_nacionalidad').val()=='NACIONAL') {
                     $('.field-personasjuridicas-rif').css('display','inherit');
                     $('.field-personasjuridicas-sys_pais_id').css('display','none');
                     $('.field-personasjuridicas-numero_identificacion').css('display','none');
                     $('#personasjuridicas-sys_pais_id').val('');
                     $('#personasjuridicas-numero_identificacion').val('');
                  
                }else{
                        if($('#personasjuridicas-tipo_nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasjuridicas-rif').css('display','none');
                        $('.field-personasjuridicas-sys_pais_id').css('display','inherit');
                        $('.field-personasjuridicas-numero_identificacion').css('display','inherit');
                        $('#personasjuridicas-rif').val('');
            
                        }
                     
                       }
                
       
        });
      
});
JS;
$this->registerJs($script);
?>
</div>
