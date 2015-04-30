<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;


/* @var $this yii\web\View */
/* @var $model common\models\p\PersonasNaturales */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personas-naturales-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($natural_juridica, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($persona_natural, 'primer_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_nombre')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'primer_apellido')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($persona_natural, 'segundo_apellido')->textInput(['maxlength' => 255]) ?>

    
    <?php ActiveForm::end(); ?>

</div>
