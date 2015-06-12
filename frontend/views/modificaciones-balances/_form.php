<?php


use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\ModificacionesBalances */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modificaciones-balances-form">

    
     <?php $form = ActiveForm::begin(); ?>

    <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>2,
    'attributes'=>$model->getFormAttribs()
      ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
