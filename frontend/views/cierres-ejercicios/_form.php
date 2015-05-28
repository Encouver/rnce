<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\p\CierresEjercicios */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cierres-ejercicios-form">

    <?php $form = ActiveForm::begin(); ?>

       <?= $form->field($model, 'fecha_cierre')->widget(
                                DatePicker::className(), [
                             // inline too, not bad
                            //'inline' => false,
                            // modify template for custom rendering
                            //'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
                            'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm'
                                ]
                                ]);?>
    <?= $form->field($model, 'documento_registrado_id')->hiddenInput()->label(false) ?>

  
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
