<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin([
        'id' => "raul",
    //'action' => ['contratistas/datosbasicos'],
        /*'enableAjaxValidation' => true,
        
        'ajaxParam'  => 'ajax'*/
        'ajaxDataType' => 'json'


]); ?>
    
    <?= $form->field($naturales_juridicas, 'tipo_persona')->dropDownList([ '0' => 'PERSONA NATURAL', '1' => 'PERSONA JURIDICA' ],
            ['prompt' => 'Seleccione tipo de persona',
                
                'onchange'=>'
                $.get( "'.Url::toRoute('contratistas/obtenertipopersona').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $("#respuesta_ajax").html( data );
                            }
                        );
            '
                
              
         
                ]) ?>

    <?= $form->field($naturales_juridicas, 'rif')->textInput(['maxlength' => 50]) ?>
    

    
    
     <div id="respuesta_ajax"></div>

    <?= $form->field($naturales_juridicas, 'denominacion')->textInput(['maxlength' => 50]) ?>    

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => 50]) ?>
    
   <!-- <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?> 
    </div>-->

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

        AjaxSubmitButton::end();
    ?>

    <?php ActiveForm::end(); ?>
    <div id = "output"></div>
</div>