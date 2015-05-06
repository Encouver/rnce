<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\p\ObjetosAutorizaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objetos-autorizaciones-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($objeto_autorizacion, 'tipo_objeto')->dropDownList($autorizado, ['prompt' => '']) ?>


    
    <?= $form->field($objeto_autorizacion, 'productos')->textarea(['rows' => 6]) ?>

    <?= $form->field($objeto_autorizacion, 'marcas')->textarea(['rows' => 6]) ?>

   
   

    <div class="form-group">
        <?= Html::submitButton($objeto_autorizacion->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $objeto_autorizacion->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
