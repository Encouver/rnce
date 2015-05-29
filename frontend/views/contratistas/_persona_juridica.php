<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-juridicas-form">

    <?php $form = ActiveForm::begin(['action'=>['contratistas/creardatojuridica'],
        'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
 
    <?php echo Form::widget([
    'model'=>$persona_juridica,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$persona_juridica->getFormAttribs()
      ]); 
    
   echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
   
    ActiveForm::end(); ?>
    
     

</div>


