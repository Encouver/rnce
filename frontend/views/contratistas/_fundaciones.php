<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

$tip_sub_denominacion = [
    ['id' => 'FUNDACION DEL ESTADO (NACIONAL)', 'name' => 'FUNDACION DEL ESTADO (NACIONAL)'],
    ['id' => 'FUNDACION DEL ESTADO (ESTADAL)', 'name' => 'FUNDACION DEL ESTADO (ESTADAL)'],
    ['id' => 'FUNDACION DEL ESTADO (MUNICIPAL)', 'name' => 'FUNDACION DEL ESTADO (MUNICIPAL)'],
];
?>

<div class="sociedad-drop" style="margin-bottom: 10px;">
    
    
    
    <?php $form = ActiveForm::begin([
        'id' => "dc_fundaciones",]); ?>

 
    <?= $form->field($d_comercial, 'tipo_subdenominacion')->dropDownList(ArrayHelper::map($tip_sub_denominacion, 'id', 'name'), ['prompt' => 'Seleccione sub denominacion']) ?>
   
     <?= $form->field($d_comercial, 'tipo_denominacion')->hiddenInput()->label(false) ?>    
    <?= $form->field($d_comercial, 'contratista_id')->hiddenInput()->label(false) ?>
    
    
   <div class="form-group centered">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar9']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
     <?php
$script = <<< JS
    $('#enviar9').click(function(e){
          
            if($('form#dc_fundaciones').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#dc_fundaciones').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/denominacioncomercial',
                    type: 'post',
                    data: $('form#dc_fundaciones').serialize(),
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


