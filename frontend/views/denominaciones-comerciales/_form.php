<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\DenominacionesComerciales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="denominaciones-comerciales-form">

   <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs()
      ]); ?>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?> 
    </div>

    <?php ActiveForm::end(); ?>

    <?php

$script = <<< JS
$( document ).ready(function() {
  
    /*  if(window.location.href.indexOf("update") > -1)
    {
         $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
        $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
        $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
        $('.field-denominacionescomerciales-codigo_situr').css('display','none');
        if($('#denominacionescomerciales-tipo_denominacion').val()=="COOPERATIVA"){
           $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','inherit');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
        }else{
            if($('#denominacionescomerciales-tipo_denominacion').val()=="ORGANIZACION SOCIOPRODUCTIVA"){
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','inherit');
                }else{
                    if($('#denominacionescomerciales-tipo_denominacion').val()=="PERSONA NATURAL" || $('#denominacionescomerciales-tipo_denominacion').val()=="FIRMA PERSONAL" || $('#denominacionescomerciales-tipo_denominacion').val()=="COMPAÑIA ANONIMA" || $('#denominacionescomerciales-tipo_denominacion').val()=="SOCIEDAD DE RESPONSABILIDAD LIMITADA" || $('#denominacionescomerciales-tipo_denominacion').val()=="COMPAÑIA NOMBRE COLECTIVO"){
                        $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                        $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                        $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                        $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    }

                }
        }

    }else {*/
    $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
        //} 
        $('#denominacionescomerciales-tipo_denominacion').click(function(e){
                switch ($('#denominacionescomerciales-tipo_denominacion').val()) {
                case "COMANDITA":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break
                case "SOCIEDAD ANONIMA":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "EMPRESA EXTRANJERA":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "FUNDACION":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "ASOCIACION CIVIL":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "SOCIEDAD CIVIL":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "SOCIEDAD DE RESPONSABILIDAD LIMITADA":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "COMPAÑIA NOMBRE COLECTIVO":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "COMPAÑIA ANONIMA":
                   $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                    $('#denominacionescomerciales-codigo_situr').val('');
                break;
                case "COOPERATIVA":
                    $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','inherit');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','none');
                    break;
                case "ORGANIZACION SOCIOPRODUCTIVA":
                    $('.field-denominacionescomerciales-tipo_subdenominacion').css('display','inherit');
                    $('.field-denominacionescomerciales-cooperativa_capital').css('display','none');
                    $('.field-denominacionescomerciales-cooperativa_distribuicion').css('display','none');
                    $('.field-denominacionescomerciales-codigo_situr').css('display','inherit');
                    $('#denominacionescomerciales-cooperativa_capital').val('');
                    $('#denominacionescomerciales-cooperativa_distribuicion').val('');
                break;
                default:
                    break;
                } 
                
       
        });
      
});
JS;
$this->registerJs($script);
?>

</div>
