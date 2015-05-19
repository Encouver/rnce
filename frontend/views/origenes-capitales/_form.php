<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */
/* @var $form yii\widgets\ActiveForm */
?>

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
        'attributes'=> ($origen_capital->scenario== 'efectivo') ? $origen_capital->getFormAttribs('efectivo') : $origen_capital->getFormAttribs('efectivoenbanco')
    ]);
    echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>

</div>
