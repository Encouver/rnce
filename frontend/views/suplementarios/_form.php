<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\Suplementarios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="suplementarios-form">

     <?php $form = ActiveForm::begin(); ?>
    
<h3>Certificados Suplementarios Suscritas y Pagadas</h3>
<hr />
 <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$model->getFormAttribs('principal')
      ]); ?>
      <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
