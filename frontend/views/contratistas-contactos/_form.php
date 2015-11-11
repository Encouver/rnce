<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\widgets\Select2; // or kartik\select2\Select2
use yii\web\JsExpression;
use yii\bootstrap\Modal;
use yii\widgets\Pjax;
use yii\helpers\Url;

$urlPersona = Url::to(['personas-naturales/create']);
$url = \yii\helpers\Url::to(['accionistas-otros/accionistas-otros-lista']);

/* @var $this yii\web\View */
/* @var $model common\models\p\ContratistasContactos */
/* @var $form yii\widgets\ActiveForm */
$persona = empty($model->contacto_id) ? '' : \common\models\p\SysNaturalesJuridicas::findOne($model->contacto_id)->denominacion;
?>

<?php
/*
<div class="comisarios-auditores-form">
     <?php  Modal::begin([
    'options'=>['id'=>'persona_natural'],
    'header' => '<h4 style="margin:0; padding:0">Agregar Persona Natural</h4>',
    'toggleButton' => ['label' => 'Agregar Persona Natural', 'class'=>'btn btn-primary','style'=>'margin-bottom:10px;'],
]);?>

<div id="output-documento">
    <?php Pjax::begin(['enablePushState' => false]);?>
        <?php $form2 = ActiveForm::begin(['id'=>$modelPersona->formName(), 'type'=>ActiveForm::TYPE_VERTICAL,'action'=>$urlPersona, 'options' => ['data-pjax' => true]]); ?>
  
            <?php echo Form::widget([
                'model'=>$modelPersona,
                'form'=>$form2,
                'columns'=>3,
                'attributes'=>$modelPersona->getFormAttribs()
            ]); ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Guardar') , ['class' =>'btn btn-success', 'id' => 'enviar-documento' ]) ?>
                </div>
        <?php ActiveForm::end(); ?>
    <?php Pjax::end();?>
</div>

<?php Modal::end();?>
*/
?>
<div class="contratistas-contactos-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'contacto_id')->widget(Select2::classname(), [
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
       'templateResult' => new JsExpression('function(contacto_id) { return contacto_id.text; }'),
        'templateSelection' => new JsExpression('function (contacto_id) { return contacto_id.text; }'),
    ],
    ]);?>
   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Guardar') : Yii::t('app', 'Actualizar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$script = <<< JS
        $( document ).ready(function() {
  
    
    $('.field-personasnaturales-sys_pais_id').css('display','none');
    $('.field-personasnaturales-rif').css('display','none');
    $('.field-personasnaturales-numero_identificacion').css('display','none');
        
    $('#personasnaturales-nacionalidad').click(function(e){
                if($('#personasnaturales-nacionalidad').val()=='NACIONAL') {
                     $('.field-personasnaturales-rif').css('display','inherit');
                     $('.field-personasnaturales-sys_pais_id').css('display','none');
                     $('.field-personasnaturales-numero_identificacion').css('display','none');
                     $('#personasnaturales-sys_pais_id').val('');
                     $('#personasnaturales-numero_identificacion').val('');
                  
                }else{
                        if($('#personasnaturales-nacionalidad').val()=='EXTRANJERA'){
                        $('.field-personasnaturales-rif').css('display','none');
                        $('.field-personasnaturales-sys_pais_id').css('display','inherit');
                        $('.field-personasnaturales-numero_identificacion').css('display','inherit');
                        $('#personasnaturales-rif').val('');
            
                        }
                     
                       }
                
       
        });
});
JS;
$this->registerJs($script);
?>
