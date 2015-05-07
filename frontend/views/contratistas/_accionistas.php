<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use common\models\p\SysNaturalesJuridicas;
/* @var $this yii\web\View */
/* @var $model common\models\p\Contratistas */
/* @var $form yii\widgets\ActiveForm */

//$contratista= Contratistas::findOne( ['id' => $id_contratista]);
//$natural_juridica= SysNaturalesJuridicas::findOne(['id' => $contratista->natural_juridica_id]);

$natural_juridica = new SysNaturalesJuridicas();
$url = \yii\helpers\Url::to(['naturaljuridicalist']);


$initScript = <<< SCRIPT
function (element, callback) {
    var id=\$(element).val();
    if (id !== "") {
        \$.ajax("{$url}?id=" + id, {
            dataType: "json"
        }).done(function(data) { callback(data.results);});
    }
}
SCRIPT;
?>

<div class="contratista-drop" style="margin-bottom: 10px;">
    
    <div id="output13"></div>
    <?php $form = ActiveForm::begin([
        'id'=>'d_comercial',
  ]); ?>
    
    
<?= $form->field($natural_juridica, 'rif')->widget(Select2::classname(), [
    'options' => ['placeholder' => 'Search for a rif ...'],
    'pluginOptions' => [
        'allowClear' => true,
        'minimumInputLength' => 3,
        'ajax' => [
            'url' => $url,
            'dataType' => 'json',
            'data' => new JsExpression('function(term,page) { return {search:term}; }'),
            'results' => new JsExpression('function(data,page) { return {results:data.results}; }'),
        ],
        'initSelection' => new JsExpression($initScript)
    ],
]);?>
     
<!--    <div class="form-group centered">
         <?/*= Html::Button(Yii::t('app', 'Seleccionar'), ['class' => 'btn btn-success', 'id' => 'enviar8']) */?>
    </div>
-->
    <?php ActiveForm::end(); ?>
    
    <div id="output14"></div>
  
</div>


