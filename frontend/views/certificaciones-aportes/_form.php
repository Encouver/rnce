<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use common\models\p\PersonasNaturales;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use common\models\p\SysPaises;

$url = \yii\helpers\Url::to(['sys-naturales-juridicas/naturales-juridicas-lista']);
$persona = empty($accionista->natural_juridica_id) ? '' : City::findOne($accionista->natural_juridica_id)->denominacion;

$persona_natural = new PersonasNaturales();
$url3 = \yii\helpers\Url::to(['personas-naturales/crearcomisario']);

        
/* @var $this yii\web\View */
/* @var $model common\models\p\CertificacionesAportes */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="modalnatural">
    
    <?php  Modal::begin([
    'options'=>['id'=>'m1_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar persona natural', 'class'=>'btn btn-lg btn-primary','style'=>'margin-bottom:10px;'],
]);?>
    <?php $form2 = ActiveForm::begin(['id'=>'modal_pnatural', 'type'=>ActiveForm::TYPE_VERTICAL]); ?>
    
    <?php echo Form::widget([
    'model'=>$persona_natural,
    'form'=>$form2,
    'columns'=>2,
    'attributes'=>$persona_natural->getformAttribs("basico")
      ]); ?>

    <div id="output15"></div>
    <div class="form-group">
         <?= Html::Button(Yii::t('app', 'Enviar'), ['class' => 'btn btn-success', 'id' => 'enviar15']) ?> 
    </div>
   
   
    <?php ActiveForm::end(); ?>
   <?php Modal::end();?>
</div>
<div class="certificaciones-aportes-form">

    
    <?php

    //$model->scenario = 'extranjero';
    $form = ActiveForm::begin([
        'type'=>ActiveForm::TYPE_VERTICAL]);?>

    <?= $form->field($certificacion_aporte, 'natural_juridica_id')->widget(Select2::classname(), [
     'initValueText' => $persona, // set the initial display text
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
        'model'=>$certificacion_aporte,
        'form'=>$form,
        'columns'=>3,
        'attributes'=> $certificacion_aporte->getFormAttribs()
    ]);
    echo Html::submitButton('Enviar', ['type'=>'button', 'class'=>'btn btn-primary']);
    ActiveForm::end();
    ?>
</div>
<?php
$script = <<< JS
    $('#enviar15').click(function(e){
          
            if($('form#modal_pnatural').find('.has-error').length!=0){
              
                return false;
            }else
            {
                //$('form#modal_pnatural').submit();
                e.preventDefault();
                e.stopImmediatePropagation();
               $.ajax({
                   
                    url: '$url3',
                    type: 'post',
                    data: $('form#modal_pnatural').serialize(),
                    success: function(data) {
                             $( "#output15" ).html( data ); 
                    }
                });
                
            }
    });
    
JS;
$this->registerJs($script);

?>
