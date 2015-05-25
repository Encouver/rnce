<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;

$url = \yii\helpers\Url::to(['accionistas-otros/accionistas-otros-lista']);

/* @var $this yii\web\View */
/* @var $model common\models\p\ContratistasContactos */
/* @var $form yii\widgets\ActiveForm */
$persona = empty($model->contacto_id) ? '' : \common\models\p\AccionistasOtros::findOne($model->contacto_id);
?>

<div class="contratistas-contactos-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'contacto_id')->widget(Select2::classname(), [
    //'initValueText' => $persona, // set the initial display text
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
        'templateResult' => new JsExpression('function(contacto_id) { return contacto_id.text; }'),
        'templateSelection' => new JsExpression('function (contacto_id) { return contacto_id.text; }'),
    ],
]);?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Agregar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
