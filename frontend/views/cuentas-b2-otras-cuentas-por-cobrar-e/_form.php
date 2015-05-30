<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrarE */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
#corriente, #nocorriente 
{
    display: none;
}
</style>
<div class="cuentas-b2-otras-cuentas-por-cobrar-e-form">
<?php
    $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>5,
        //'columns'=>11,
        'attributes'=> $model->getFormAttribs()
    ]);
?>
<div id="corriente">
    <h4>Corriente</h4>
<?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        //'columns'=>11,
        'attributes'=> $model->getFormA()
    ]);
?>
</div>
<div id="nocorriente">
    <h4>No corriente</h4>
<?php
    echo Form::widget([
        'model'=>$model,
        'form'=>$form,
        'columns'=>4,
        //'columns'=>11,
        'attributes'=> $model->getFormB()
    ]);
?>
</div>
    <?php
        echo Html::submitButton('Submit', ['type'=>'button', 'class'=>'btn btn-primary']);
        ActiveForm::end();
    ?>  
</div>
<?php
$script = <<< JS
$( document ).ready(function() {
    $('#cuentasb2otrascuentasporcobrare-corriente').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-corriente').is(':checked'))
        {
           var checked = $('#cuentasb2otrascuentasporcobrare-corriente').attr('checked');
            if (checked) {
                $(this).removeAttr('checked');
            }else{
                $(this).attr('checked', '');
            }

           $('#corriente').css('display', 'inherit');
        }else
        {
            $('#cuentasb2otrascuentasporcobrare-corriente').removeAttr('checked');
            $('#corriente').css('display', 'none');
        }
    });

    $('#cuentasb2otrascuentasporcobrare-nocorriente').click(function() {
        if($('#cuentasb2otrascuentasporcobrare-nocorriente').is(':checked'))
        {
         var checked = $('#cuentasb2otrascuentasporcobrare-nocorriente').attr('checked');
            if (checked) {
                $(this).removeAttr('checked');
            }else{
                $(this).attr('checked', '');
            }

           $('#nocorriente').css('display', 'inherit');
        }else
        {
            $('#cuentasb2otrascuentasporcobrare-nocorriente').removeAttr('checked');
            $('#nocorriente').css('display', 'none');
        }
    });
});

JS;
$this->registerJs($script);
?>

 