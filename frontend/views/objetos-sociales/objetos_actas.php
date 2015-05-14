<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$url = \yii\helpers\Url::to(['objetos-sociales/objetoacta']);
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-actas-form col-sm-9">

    <?php $form = ActiveForm::begin(['id'=>'o_actas']); ?>
    

    <?= $form->field($objeto_social, 'descripcion')->textarea(['rows' => 6]) ?>
     <div id="output17"></div>
     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
       <?php
$script = <<< JS
   
     $('#enviar').click(function(e){
          
            if($('form#o_actas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#o_actas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#o_actas').serialize(),
                    success: function(data) {
                             $( "#output17" ).html( data ); 
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
</div>
