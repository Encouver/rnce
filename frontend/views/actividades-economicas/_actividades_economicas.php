<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\p\SysCaev;
/* @var $this yii\web\View */
/* @var $model common\models\p\ActividadesEconomicas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="actividades-economicas-form">

    <?php $form = ActiveForm::begin([
        'id' => "a_economica",
  

]); ?>
    <div id="output7"></div>
     <?= $form->field($actividad_economica, 'ppal_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione Actividad economica principal'] 
             ) ?>

    
    <?= $form->field($actividad_economica, 'ppal_experiencia')->textInput() ?>

     <?= $form->field($actividad_economica, 'comp1_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione actividad economica complementaria 1'] 
             ) ?>
    
     <?= $form->field($actividad_economica, 'comp1_experiencia')->textInput() ?>

     <?= $form->field($actividad_economica, 'comp2_caev_id')->dropDownList(
        ArrayHelper::map(SysCaev::find()->all(),'id','denominacion'),
        ['prompt' => 'Seleccione actividad economica complementaria 2'] 
             ) ?>
    

    <?= $form->field($actividad_economica, 'comp2_experiencia')->textInput() ?>

      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar7']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
    <?php
$script = <<< JS
    $('#enviar7').click(function(e){
          
            if($('form#a_economica').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#p_contacto').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/actividadeconomica',
                    type: 'post',
                    data: $('form#a_economica').serialize(),
                    success: function(data) {
                             $( "#output7" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>

</div>
