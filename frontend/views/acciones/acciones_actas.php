<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-actas-form">

    <?php $form = ActiveForm::begin(['id'=>'accion_suscrita',
        'method'=>'post',
        'action'=>['acciones/accionsuscritaacta'],
        'enableClientValidation'=>true,
        'enableAjaxValidation'=>false]); ?>
    
<h3>Acciones o Participaciones Suscritas y Pagadas</h3>
<hr />
 <?php echo Form::widget([
    'model'=>$accion_acta,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$accion_acta->formAttribsactas
      ]); ?>
    <div id="output17"></div>
       <div class="form-group">
        <?= Html::submitButton($accion_acta->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $accion_acta->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
       <?php
/*$script = <<< JS
   
     $('#enviar').click(function(e){
          
            if($('form#accion_suscrita').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#accion_suscrita').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#accion_suscrita').serialize(),
                    success: function(data) {
                             $( "#output17" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);*/

?>
</div>
