<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['denominaciones-comerciales/denominacioncomercial']);

?>
<style type="text/css">
.tamano
{
	width: 400px;
	max-width: 400px;
}
</style>
<div class="sociedad-drop" style="margin-bottom: 10px;">
    
    

    <?php $form = ActiveForm::begin([
        'id' => "dc_cooperativas",]); ?>

 
    <?= $form->field($d_comercial, 'cooperativa_capital')->dropDownList([ 'SUPLEMENTARIO' => 'SUPLEMENTARIO', 'LIMITADO' => 'LIMITADO', ], ['class' => 'form-control tamano','prompt' => 'Seleccione']) ?>

    <?= $form->field($d_comercial, 'cooperativa_distribuicion')->dropDownList([ 'UTILIDADES' => 'UTILIDADES', 'EXCEDENTES' => 'EXCEDENTES', ], ['class' => 'form-control tamano','prompt' => 'Seleccione']) ?> 
   
    
    <?= $form->field($d_comercial, 'tipo_denominacion')->hiddenInput()->label(false) ?>

     <?= $form->field($d_comercial, 'contratista_id')->hiddenInput()->label(false) ?>

    
   <div class="form-group centered">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar9']) ?>
    </div>

    <?php ActiveForm::end(); ?>
     <?php
$script = <<< JS
    $('#enviar9').click(function(e){
          
            if($('form#dc_cooperativas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#dc_cooperativas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#dc_cooperativas').serialize(),
                    success: function(data) {
                             $( "#output9" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
</div>


