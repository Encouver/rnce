<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['denominaciones-comerciales/denominacioncomercial']);
$tip_sub_denominacion = [
    ['id' => 'CON FINES DE LUCRO', 'name' => 'CON FINES DE LUCRO'],
    ['id' => 'SIN FINES DE LUCRO', 'name' => 'SIN FINES DE LUCRO'],
   
];
?>
<style type="text/css">
.tamano
{
	width: 400px;
	max-width: 400px;
}
</style>
<div class="sociedades-drop" style="margin-bottom: 10px;">
  
    
    <?php $form = ActiveForm::begin([
        'id' => "dc_asociedades",]); ?>

 
    <?= $form->field($d_comercial, 'tipo_subdenominacion')->dropDownList(ArrayHelper::map($tip_sub_denominacion, 'id', 'name'), ['class' => 'form-control tamano','prompt' => 'Seleccione sub denominacion']) ?>
   
     <?= $form->field($d_comercial, 'tipo_denominacion')->hiddenInput()->label(false) ?>    
    <?= $form->field($d_comercial, 'contratista_id')->hiddenInput()->label(false) ?>
    
    
   <div class="form-group centered">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar9']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
     <?php
$script = <<< JS
    $('#enviar9').click(function(e){
          
            if($('form#dc_asociedades').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#dc_asociedades').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#dc_asociedades').serialize(),
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


