<?php

use kartik\popover\PopoverX;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use kartik\builder\Form;

$form = ActiveForm::begin(['fieldConfig'=>['showLabels'=>true]]);
PopoverX::begin([
    'placement' => PopoverX::ALIGN_RIGHT,
     'type' => PopoverX::TYPE_PRIMARY,
    'size' => PopoverX::SIZE_MEDIUM,
    'toggleButton' => ['label'=>'<i class="glyphicon glyphicon-plus"></i> Agregar Efectivo en banco', 'class'=>'btn btn-success'],
    'header' => 'Efectivo en banco',
    'footer'=>Html::submitButton('Submit', ['class'=>'btn btn-sm btn-primary']) .
        Html::resetButton('Reset', ['class'=>'btn btn-sm btn-default'])
]);
 echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>2,
        //'columns'=>11,
        'attributes'=>$model->getFormAttribs()
    ]);
//echo $form->field($model, 'status')->textInput(['placeholder'=>'Enter password...']);
PopoverX::end();

ActiveForm::end();