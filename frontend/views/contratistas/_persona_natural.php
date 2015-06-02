<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin(['action'=>['contratistas/creardatonatural'],
        'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    
 
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$persona_natural->getFormAttribs()
      ]); 
    
   echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
   
    ActiveForm::end(); ?>
    
     

</div>


