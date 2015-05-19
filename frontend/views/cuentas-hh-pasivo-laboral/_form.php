<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasHhPasivoLaboral */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cuentas-hh-pasivo-laboral-form">
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

<?php

$script = <<< JS
$( document ).ready(function() {
    if(window.location.href.indexOf("update") > -1)
    {
        if($('#cuentashhpasivolaboral-hh_concepto_id').val()!=5){
           $('.field-cuentashhpasivolaboral-otro_nombre').css('display','none');  
        }

        $('#cuentashhpasivolaboral-hh_concepto_id').click(function(e){
                if($('#cuentashhpasivolaboral-hh_concepto_id').val()==5){
                  $('.field-cuentashhpasivolaboral-otro_nombre').css('display','inherit'); 
                }else{
                  $('.field-cuentashhpasivolaboral-otro_nombre').css('display','none');                 
                }
        });

    }else
    {

        $('.field-cuentashhpasivolaboral-otro_nombre').css('display','none');
        $('#cuentashhpasivolaboral-hh_concepto_id').click(function(e){
                if($('#cuentashhpasivolaboral-hh_concepto_id').val()==5){
                  $('.field-cuentashhpasivolaboral-otro_nombre').css('display','inherit'); 
                }else{
                  $('.field-cuentashhpasivolaboral-otro_nombre').css('display','none');                 
                }
        });
    }   
});
JS;
$this->registerJs($script);
?>