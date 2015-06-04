<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\Acciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="acciones-form">

   
    <?php $form = ActiveForm::begin(); ?>
    
<h3>Acciones o Participaciones Suscritas y Pagadas</h3>
<hr />
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->formAttribsactas
      ]); ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
