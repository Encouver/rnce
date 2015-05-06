<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */




$data = [
 'PROVEEDOR'=> ['PRODUCTOR'=>'PRODUCTOR', 'FABRICANTE'=>'FABRICANTE','FABRICANTE IMPORTADOR'=>'FABRICANTE IMPORTADOR', 'DISTRIBUIDOR'=>'DISTRIBUIDOR','DISTRIBUIDOR AUTORIZADO'=>'DISTRIBUIDOR AUTORIZADO','DISTRIBUIDOR IMPORTADOR'=>'DITRIBUIDOR IMPORTADOR','DISTRIBUIDOR IMPORTADOR AUTORIZADO'=>'DISTRIBUIDOR IMPORTADOR AUTORIZADO'],
 'SERVICIOS'=>['SERVICIOS BASICOS'=>'SERVICIOS BASICOS' ,'SERVICIOS PROFESIONALES'=>'SERVICIOS PROFESIONALES','SERVICIOS COMERCIALES'=>'SERVICIOS COMERCIALES','SERVICIOS COMERCIALES AUTORIZADO'=>'SERVICIOS COMERCIALES AUTORIZADO'],
 'OBRAS'=>['OBRAS' => "OBRAS",]
 ];
?>

<div class="sociedades-drop" style="margin-bottom: 10px;">
    
    
    
    <?php $form = ActiveForm::begin([
        'id' => "o_empresas",]); ?>

   
    
<?= '<label class="control-label">Objeto de la empresa</label>'; ?>
<?= Select2::widget([
    'name' => 'objeto', 
    'data' => $data,
    'options' => [
        'placeholder' => 'Select provinces ...', 
        'multiple' => true
    ],

]);?>
    <br>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar10']) ?> 
    </div>
  
    <?php ActiveForm::end(); ?>
    <br>
    <br>
    <br>
    <br>
    
       <div id="output10"></div>
     <?php
$script = <<< JS
    $('#enviar10').click(function(e){
          
            if($('form#o_empresas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#o_empresas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/raul',
                    type: 'post',
                    data: $('form#o_empresas').serialize(),
                    success: function(data) {
                             $( "#output10" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
</div>


