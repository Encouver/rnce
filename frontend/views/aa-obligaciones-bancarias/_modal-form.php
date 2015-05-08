<?php

use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;


$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>false]]);
PopoverX::begin([
    'placement' => PopoverX::ALIGN_TOP,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-plus"></i> Agregar', 'class'=>'btn btn-success'],
    'header' => '<i class="glyphicon glyphicon-lock"></i> Enter credentials',
    'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
        Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
]);
echo $form->field($model, 'corriente')->checkbox(['placeholder'=>'Enter user...']);
//echo $form->field($model, 'status')->textInput(['placeholder'=>'Enter password...']);
PopoverX::end();

ActiveForm::end();