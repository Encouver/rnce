<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use yii\web\JsExpression;



/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */
/* @var $form yii\widgets\ActiveForm */
$escenario=null;
if($origen_capital->tipo_origen=='EFECTIVO'){
    $escenario="EFECTIVO";
}else{
    if($origen_capital->tipo_origen=='EFECTIVO EN BANCO'){
    $escenario="EFECTIVO EN BANCO";
    }else{
        $escenario="BIEN";
        }
    
}
?>
<style type="text/css">
.tamano
{
	width: 400px;
	max-width: 400px;
}
</style>


<div class="origenes-capitales-form">

    <?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin([
        'action'=>['origenes-capitales/crearcapital'],
        'type'=>ActiveForm::TYPE_VERTICAL]);?>
    
     <?= $form->field($origen_capital, 'tipo_origen')->hiddenInput()->label(false) ?>
   <?php echo Form::widget([
        'model'=>$origen_capital,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> $origen_capital->getFormAttribs($escenario)
    ]);
    echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
