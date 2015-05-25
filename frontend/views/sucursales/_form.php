<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model common\models\p\Sucursales */
/* @var $form yii\widgets\ActiveForm */
$url = \yii\helpers\Url::to(['accionistas-otros/accionistas-otros-lista']);
//$persona = empty($model->natural_juridica_id) ? '' : City::findOne($model->natural_juridica_id)->denominacion;


?>

<div class="sucursales-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'natural_juridica_id')->widget(Select2::classname(), [
    'initValueText' => '', // set the initial display text
    'options' => ['placeholder' => 'Numero de identificacion ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(params) { return {q:params.term}; }')
        ],
       'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
        'templateResult' => new JsExpression('function(natural_juridica_id) { return natural_juridica_id.text; }'),
        'templateSelection' => new JsExpression('function (natural_juridica_id) { return natural_juridica_id.text; }'),
    ],
]);?>
    <?php echo Form::widget([
    'model'=>$direccion,
    'form'=>$form,
    'columns'=>3,
    'attributes'=>$direccion->getFormAttribs('principal')
      ]); ?>
     <div class="form-group">
         <?= Html::submitButton(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success']) ?> 
    </div>
    <?php ActiveForm::end(); ?>

</div>
