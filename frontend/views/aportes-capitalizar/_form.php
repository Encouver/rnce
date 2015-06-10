<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\AportesCapitalizar */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="aportes-capitalizar-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>4,
    'attributes'=>$model->getFormAttribs()
      ]); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar Aporte') : Yii::t('app', 'Actualizar Aporte'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
