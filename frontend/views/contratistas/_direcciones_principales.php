<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysEstados;
use common\models\p\SysMunicipios;
use common\models\p\SysParroquias;

/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin([
        'id' => "d_principal",
  

]); ?>
    <div id="output3"></div>
    <?= $form->field($direccion, 'sys_estado_id')->dropDownList(
        ArrayHelper::map(SysEstados::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Estado'] 
             ) ?>
    
    <?= $form->field($direccion, 'sys_municipio_id')->dropDownList(
        ArrayHelper::map(SysMunicipios::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Municipio'] 
             ) ?>
    
     <?= $form->field($direccion, 'sys_parroquia_id')->dropDownList(
        ArrayHelper::map(SysParroquias::find()->all(),'id','nombre'),
        ['prompt' => 'Seleccione Parroquia'] 
             ) ?>

     <?= $form->field($direccion, 'zona')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($direccion, 'calle')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($direccion, 'casa')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($direccion, 'nivel')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($direccion, 'numero')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($direccion, 'referencia')->textarea(['rows' => 6]) ?>

    

     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar2']) ?> 
    </div>
   
    <?php ActiveForm::end(); ?>
    
     <?php
$script = <<< JS
    $('#enviar2').click(function(e){
          
            if($('form#d_principal').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#d_principal').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/direccionprincipal',
                    type: 'post',
                    data: $('form#d_principal').serialize(),
                    success: function(data) {
                             $( "#output3" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>


