<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

$tip_persona = [
    ['id' => '0', 'name' => 'PERSONA NATURAL'],
    ['id' => '1', 'name' => 'PERSONA JURIDICA'],
];
?>

<div class="contratista-drop" style="margin-bottom: 10px;">
    
    
    <?= Html::dropDownList("Tipo de persona","", ArrayHelper::map($tip_persona, 'id', 'name'),
             ['prompt' => 'Seleccione tipo de persona',
               
               'onchange'=>'
                        $.get( "'.Url::toRoute('/contratistas/obtenertipopersona').'", { id: $(this).val() } )
                            .done(function( data ) {
                                $( "#response_ajax" ).html( data );
                            }
                        );
                    '    
                
              
              
         
                ]
            
            ) ?>
</div>


<div id="response_ajax" style="height: 500px;"></div>

