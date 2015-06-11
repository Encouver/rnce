<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;


/* @var $this yii\web\View */
/* @var $model common\models\p\CorreccionesMonetarias */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="correcciones-monetarias-form">

      <?php $form = ActiveForm::begin(); ?>

    <?php echo Form::widget([
    'model'=>$model,
    'form'=>$form,
    'columns'=>4,
    'attributes'=>$model->getFormAttribs()
      ]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Crear') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
 <?php
$script = <<< JS
        $( document ).ready(function() {
        //$("#correccionesmonetarias-total_accion_comun").prop('disabled', true);
       // $("#correccionesmonetarias-total_accion").prop('disabled', true);
        });
JS;
$this->registerJs($script);
?>
</div>
