<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
$url = \yii\helpers\Url::to(['cierres-ejercicios/cierreacta']);
/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-actas-form col-sm-6">

    <?php $form = ActiveForm::begin(['id'=>'cierre_actas']); ?>
    

       <?= $form->field($cierre_ejercicio, 'fecha_cierre')->widget(
                                DatePicker::className(), [
                             // inline too, not bad
                            //'inline' => false,
                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm'
                                ]
                                ]);?>
     <div id="output17"></div>
     <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>

    <?php ActiveForm::end(); ?>
       <?php
$script = <<< JS
   
     $('#enviar').click(function(e){
          
            if($('form#cierre_actas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#cierre_actas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#cierre_actas').serialize(),
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
