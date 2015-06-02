<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
/* @var $this yii\web\View */
/* @var $model common\models\p\ContratosFacturas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratos-facturas-form">

   <?php $form = ActiveForm::begin(['id'=>$model->formName(), 'type'=>ActiveForm::TYPE_VERTICAL, 'options' => ['data-pjax' => Yii::$app->request->isPjax]]);  ?>
     <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
        }
    ?>
    
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

</div>
