<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use demogorgorn\ajax\AjaxSubmitButton;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="contratistas-form">

    <?php $form = ActiveForm::begin([
        'id' => "raul",
        //'action' => 'contratista/datosbasicos',
        //'enableAjaxValidation' => false,
        //'enableClientValidation' => true,


]); ?>

    <?= $form->field($model2, 'rif')->textInput(['maxlength' => 50]) ?>
    

    <?= $form->field($model2, 'tipo_persona')->dropDownList([ '0' => 'PERSONA NATURAL', '1' => 'PERSONA JURIDICA' ],
            ['prompt' => 'Seleccione tipo de persona',
                
                'onchange'=>'
                $.get( "'.Url::toRoute('contratistas/obtenertipopersona').'", { id: $(this).val() } )
                            .done(function( data ) {
                            alert(data);
                                $("#sector").html( data );
                            }
                        );
            '
                
              
         
                ]) ?>
    
     <div id = "sector"></div>

    <?= $form->field($model2, 'denominacion')->textInput(['maxlength' => 50]) ?>    

    <?= $form->field($model, 'sigla')->textInput(['maxlength' => 50]) ?>
    
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Create'), ['class' => 'btn btn-success', 'id' => 'enviar']) ?> 
    </div>
     <?php ActiveForm::end(); ?>

    <?php
$script = <<< JS
    $('#enviar').click(function(e){
          
            if($('form#raul').find('.has-error').length!=0){
                alert("probando");
                return false;
            }else
            {
                //$('form#raul').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: 'http://localhost/rnce/frontend/web/index.php?r=contratistas/datosbasicos',
                    type: 'post',
                    data: $('form#raul').serialize(),
                    success: function(data) {
                                // do something ...
                        alert(data);
                    }
                });
                
            }
    });
JS;
$this->registerJs($script);

?>
   


    <div id = "output"></div>
</div>

