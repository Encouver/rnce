<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\models\p\Contratistas;
use common\models\p\SysNaturalesJuridicas;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

$contratista= Contratistas::findOne( ['id' => $id_contratista]);
$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);
if($natural_juridica->juridica && $contratista->tipo_sector != "PRIVADO"){
    $denominacion = [
    ['id' => 'COMPAÑIA ANONIMA', 'name' => 'COMPAÑIA ANONIMA'],
    ['id' => 'SOCIEDAD ANONIMA', 'name' => 'SOCIEDAD ANONIMA'],
    ['id' => 'COMANDITA', 'name' => 'COMANDITA'],
    ['id' => 'FUNDACION', 'name' => 'FUNDACION'],
    ['id' => 'ASOCIACION CIVIL', 'name' => 'ASOCIACION CIVIL'],
    ['id' => 'SOCIEDAD CIVIL', 'name' => 'SOCIEDAD CIVIL'],
    ['id' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA', 'name' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA'],
    ['id' => 'COMPAÑIA NOMBRE COLECTIVO', 'name' => 'COMPAÑIA NOMBRE COLECTIVO'],
    ['id' => 'ORGANIZACION SOCIOPRODUCTIVA', 'name' => 'ORGANIZACION SOCIOPRODUCTIVA'],
    ['id' => 'COOPERATIVA', 'name' => 'COOPERATIVA'],
    ['id' => 'EMPRESA EXTRANJERA', 'name' => 'EMPRESA EXTRANJERA'],
        
        ];
}else{
    if($natural_juridica->juridica){
         $denominacion = [
    ['id' => 'COMPAÑIA ANONIMA', 'name' => 'COMPAÑIA ANONIMA'],
    ['id' => 'SOCIEDAD ANONIMA', 'name' => 'SOCIEDAD ANONIMA'],
    ['id' => 'COMANDITA', 'name' => 'COMANDITA'],
    ['id' => 'ASOCIACION CIVIL', 'name' => 'ASOCIACION CIVIL'],
    ['id' => 'SOCIEDAD CIVIL', 'name' => 'SOCIEDAD CIVIL'],
    ['id' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA', 'name' => 'SOCIEDAD DE RESPONSABILIDAD LIMITADA'],
    ['id' => 'COMPAÑIA NOMBRE COLECTIVO', 'name' => 'COMPAÑIA NOMBRE COLECTIVO'],
    ['id' => 'ORGANIZACION SOCIOPRODUCTIVA', 'name' => 'ORGANIZACION SOCIOPRODUCTIVA'],
    ['id' => 'COOPERATIVA', 'name' => 'COOPERATIVA'],
    ['id' => 'EMPRESA EXTRANJERA', 'name' => 'EMPRESA EXTRANJERA'],
        
        ];
    }else{
         $denominacion = [
    ['id' => 'PERSONA NATURAL', 'name' => 'PERSONA NATURAL'],
    ['id' => 'FIRMA PERSONAL', 'name' => 'FIRMA PERSONAL'],];
    }
    
}


?>

<div class="contratista-drop col-sm-9" style="margin-bottom: 10px;">
    
    <div id="output9"></div>
    <?php $form = ActiveForm::begin([
        'id'=>'d_comercial',
  ]); ?>
    
    
    <?= $form->field($denominacion_comercial, 'tipo_denominacion')->dropDownList(ArrayHelper::map($denominacion, 'id', 'name'), ['prompt' => 'Seleccione tipo de denominacion'])?>
    
<!--    <div class="form-group centered">
         <?/*= Html::Button(Yii::t('app', 'Seleccionar'), ['class' => 'btn btn-success', 'id' => 'enviar8']) */?>
    </div>
-->
    <?php ActiveForm::end(); ?>
    
    <div id="output8"></div>
     <?php
$script = <<< JS
    $('#denominacionescomerciales-tipo_denominacion').change(function(e){

            if($('form#d_comercial').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#d_comercial').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=denominaciones-comerciales/denominacion',
                    type: 'post',
                    data: $('form#d_comercial').serialize(),
                    success: function(data) {
                             $( "#output8" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
</div>


