<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\p\CierresEjercicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cierres-ejercicios-form">

    <?php $form = ActiveForm::begin(); ?>

     <?= $form->field($model, 'fecha_cierre')->widget(\yii\jui\DatePicker::classname(), [
    //'language' => 'ru',
    'dateFormat' => 'yyyy-MM-dd',
    ])  ?>


  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
