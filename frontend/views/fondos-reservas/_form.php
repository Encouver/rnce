<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\p\FondosReservas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fondos-reservas-form">

    <?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_VERTICAL]);?>
    
   <?php echo Form::widget([
        'model'=>$fondo_reserva,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> $fondo_reserva->getFormAttribs()
    ]);
    echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>


</div>
