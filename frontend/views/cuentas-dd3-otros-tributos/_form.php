<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasDd3OtrosTributos */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-dd3-otros-tributos-form">
<?php


    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
    echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>  
</div>
