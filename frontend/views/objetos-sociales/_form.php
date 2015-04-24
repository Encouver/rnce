<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosSociales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-sociales-form">

    <?php $form = ActiveForm::begin(); ?>
    


    <?php /*$form->field($model, 'tipo_objeto')->dropDownList([ 'PRINCIPAL' => 'PRINCIPAL', 'AMPLIACION' => 'AMPLIACION', 'MODIFICACION PARCIAL' => 'MODIFICACION PARCIAL', 'MODIFICACION TOTAL' => 'MODIFICACION TOTAL', ], ['prompt' => '']) */ ?>

    <?= $form->field($model, 'descripcion')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
