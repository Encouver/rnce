<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin([
  

]); ?>

    <?= $form->field($model2, 'rif')->textInput(['maxlength' => 50]) ?>
    
    <?= $form->field($model2, 'tipo_persona')->dropDownList([ '0' => 'PERSONA NATURAL', '1' => 'PERSONA JURIDICA' ],
            ['prompt' => 'Seleccione tipo de persona',
                
                'onchange'=>'
                $.post( "'.Yii::$app->urlManager->createUrl('contratistas/datos','id=>$(this).val()').', function( data ) {
                  $( "#sector" ).html( data );
                });
            '
                
              
         
                ]) ?>
    
     <div id = "sector"></div>
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
            'format'=>'JSON',
            'url'=>Yii::$app->urlManager->createUrl('contratistas/datosbasicos'),
            /*'cache' => false,*/
            'success' => new \yii\web\JsExpression('function(html){
                $("#output").html(html);
                    alert(html);
                    //alert(html.respuesta);
                }'),
        ],
        'options' => ['class' => 'btn btn-success', 'type' => 'submit'],
        ]);

        AjaxSubmitButton::end();
    ?>

    <?php ActiveForm::end(); ?>
    <div id = "output"></div>
</div>