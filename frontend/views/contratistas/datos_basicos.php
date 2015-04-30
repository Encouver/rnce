<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Json;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin([
        'id' => "raul",
        //'htmlOptions'=>array('enctype'=>'application/json'),
    //'action' => ['contratistas/datosbasicos'],
        'enableAjaxValidation' => false,
        /*
        'ajaxParam'  => 'ajax'*/
        //'ajaxDataType' => 'json'


]); ?>

    <?= $form->field($model2, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model2, 'denominacion')->textInput(['maxlength' => 50]) ?>    

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model, 'tipo_sector')->dropDownList([ 'PUBLICO' => 'PUBLICO', 'PRIVADO' => 'PRIVADO', 'MIXTO' => 'MIXTO' ], ['prompt' => '']) ?>
   
   <!-- <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?> 
    </div>-->

    <?php AjaxSubmitButton::begin([
        'label' => 'Enviar',
        'ajaxOptions' => [
            'type'=>'POST',
            //'encode' => 'identity',
            'dataType' => "json",
            'contentType' => "application/json; charset=utf-8",
            'url'=>Yii::$app->urlManager->createUrl('contratistas/datosbasicos'),
            /*'cache' => false, */
            //'data'=> new \yii\web\JsExpression('Jquery(form).serialize'),
            
        ],
        'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
        ]);

        AjaxSubmitButton::end();
    ?>

    <?php ActiveForm::end(); ?>
    <div id = "output"></div>
</div>