<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

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

     <?php AjaxSubmitButton::begin([
        'label' => 'Enviar',
        'ajaxOptions' => [
            'type'=>'POST',
            //'contentType' => "application/json; charset=utf-8",
             'dataType' => "json",
            'url'=>Yii::$app->urlManager->createUrl('contratistas/datosbasicos'),
            /*'cache' => false, */
            //'data' => '$("#raul").serialize()',
            'success' => new \yii\web\JsExpression('function(html){
                $("#output").html(html);
                    alert("raul es marico");
                }'),
        ],
        'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
        ]);

        AjaxSubmitButton::end();?>
    <?php ActiveForm::end(); ?>

</div>
