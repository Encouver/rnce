<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

$tip_sub_denominacion = [
    ['id' => 'CON FINES DE LUCRO', 'name' => 'CON FINES DE LUCRO'],
    ['id' => 'SIN FINES DE LUCRO', 'name' => 'SIN FINES DE LUCRO'],
   
];
$data = [
 'PROVEEDOR'=> [1=>'Producto 1', 2=>'Producto 2'],
 'SERVICIOS'=>[3=>'Producto 3' ,   4=>'Producto 4'],
 'OBRAS'=>'OBRAS'
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
    
   <div class="form-group centered">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar10']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
     <?php
$script = <<< JS
    $('#enviar10').click(function(e){
          
            if($('form#dc_asociedades').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#dc_asociedades').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/denominacioncomercial',
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


