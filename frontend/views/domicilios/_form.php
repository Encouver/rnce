<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\Domicilios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="domicilios-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
     <?= $form->field($model, 'fiscal')->hiddenInput()->label(false) ?>
 <?php echo Form::widget([
    'model'=>$direccion,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>($model->fiscal) ? $direccion->getFormAttribs('fiscal') : $direccion->getFormAttribs('principal')
      ]); ?>
     <?= print_r($direccion);?>
    <?= print_r($model);?>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?> 
    </div>

    <?php ActiveForm::end(); ?>

</div>
