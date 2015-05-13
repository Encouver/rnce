<?php


use yii\jui\DatePicker;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\web\JsExpression;
use kartik\builder\Form;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$url = \yii\helpers\Url::to(['documentos-registrados/registroacta']);

?>

<div class="col-sm-9" style="margin-bottom: 10px;">
    
   
    <?php $form = ActiveForm::begin([
        'id'=>'r_actas',
        'type'=>ActiveForm::TYPE_VERTICAL
  ]); ?>
    

     <?php echo Form::widget([
    'model'=>$registro_acta,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$registro_acta->formAttribs
      ]); ?>
    
  
     
    
    <div id="output17"></div>
      <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>
    <?php ActiveForm::end(); ?>
    
    
    
    
    

   <?php
$script = <<< JS
   
     $('#enviar').click(function(e){
          
            if($('form#r_actas').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#r_actas').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url',
                    type: 'post',
                    data: $('form#r_actas').serialize(),
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



